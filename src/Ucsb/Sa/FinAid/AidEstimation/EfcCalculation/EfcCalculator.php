<?php
namespace Ucsb\Sa\FinAid\AidEstimation\EfcCalculation;

/**
 * Expected Family Contribution (EFC) calculator
 * @package Ucsb\Sa\FinAid\AidEstimation\EfcCalculation
 */
class EfcCalculator
{
	const DefaultMonthsOfEnrollment = 9;
	const AnnualMonthsOfEnrollment = 12;

	private $_constants;
	private $_incomeCalculator;
	private $_allowanceCalculator;
	private $_assetContributionCalculator;
	private $_aaiContributionCalculator;

	/**
	 * Constructs a new Expected Family Contribution (EFC) calculator
	 * @param EfcCalculatorConstants $constants Constants used in the calculation of Expected Family Contribution (EFC)
	 * @param IncomeCalculator $incomeCalculator Calculator used in income calculations
	 * @param AllowanceCalculator $allowanceCalculator Calculator used in allowance calculations
	 * @param AssetContributionCalculator $assetContributionCalculator Calculator used in asset contribution calculations
	 * @param AaiContributionCalculator $aaiContributionCalculator Calculator used in Adjusted Available Income (AAI) contribution calculations
	 */
	public function __construct($constants, $incomeCalculator, $allowanceCalculator, $assetContributionCalculator, $aaiContributionCalculator)
	{
		$this->_constants = $constants;
		$this->_incomeCalculator = $incomeCalculator;
		$this->_allowanceCalculator = $allowanceCalculator;
		$this->_assetContributionCalculator = $assetContributionCalculator;
		$this->_aaiContributionCalculator = $aaiContributionCalculator;
	}

	/**
	 * Calculates parent contribution (PC), student contribution (SC), and expected family contribution (EFC) for
	 * a dependent student
	 * @param DependentEfcCalculatorArguments $args Parameters for the calculation
	 * @return EfcProfile
	 */
	public function getDependentEfcProfile($args)
	{
        if ($args->numberInCollege <= 0
            || $args->monthsOfEnrollment <= 0
            || $args->student == null)
        {
            return new EfcProfile(0, 0, 0, 0);
        }

        $workIncome = 0;
        $parents = array();

        if ($args->firstParent != null)
        {
            if ($args->firstParent->isWorking)
            {
                $workIncome += $args->firstParent->workIncome;
            }

            $parents[] = $args->firstParent;
        }

        if ($args->secondParent != null)
        {
            if ($args->secondParent->isWorking)
            {
                $workIncome += $args->secondParent->workIncome;
            }

            $parents[] = $args->secondParent;
        }

        $simpleIncome = ($args->areParentsTaxFilers) ? $args->parentAdjustedGrossIncome : $workIncome;

        // Determine Auto Zero EFC eligibility
        if ($args->isQualifiedForSimplified && $simpleIncome <= $this->_constants->autoZeroEfcMax)
        {
            return new EfcProfile(0, 0, 0, 0);
        }

		// Parent's Total Income
        $parentTotalIncome = $this->_incomeCalculator->calculateTotalIncome(
                                        $args->parentAdjustedGrossIncome,
                                        $workIncome,
                                        $args->areParentsTaxFilers,
                                        $args->ParentUntaxedIncomeAndBenefits,
                                        $args->ParentAdditionalFinancialInfo);

        // Parent's Total Allowances
        $parentTotalAllowances = $this->_allowanceCalculator->calculateTotalAllowances(
                                        EfcCalculationRole::Parent,
                                        $args->MaritalStatus,
                                        $args->StateOfResidency,
                                        $args->NumberInCollege,
                                        $args->NumberInHousehold,
                                        $parents,
                                        $parentTotalIncome,
                                        $args->ParentIncomeTaxPaid);

		// Parent's Available Income
        $parentAvailableIncome = $this->_incomeCalculator->calculateAvailableIncome(
        								EfcCalculationRole::Parent,
        								$parentTotalIncome,
        								$parentTotalAllowances);

        // Determine Simplified EFC Equation Eligibility
        $useSimplified = ($args->isQualifiedForSimplified && $simpleIncome <= $this->_constants->simplifiedEfcMax);

        // Parent's Contribution From Assets
        $parentAssetContribution = 0;

        if (!$useSimplified)
        {
            $parentAssetContribution = $this->_assetContributionCalculator->calculateContributionFromAssets(
                						EfcCalculationRole::Parent,
						                $args->MaritalStatus,
						                $args->OldestParentAge,
						                $args->ParentCashSavingsChecking,
						                $args->ParentInvestmentNetWorth,
						                $args->ParentBusinessFarmNetWorth);
        }

        // Parent's Adjusted Available Income
        $parentAdjustedAvailableIncome = $parentAvailableIncome + $parentAssetContribution;

        // Parent's Contribution from AAI
        $parentContributionFromAai =
            $this->_aaiContributionCalculator->calculateContributionFromAai(
            							EfcCalculationRole::Parent,
            							$parentAdjustedAvailableIncome);

        // Parent Contribution
        $parentContribution = EfcMathHelper::round($parentContributionFromAai/$args->numberInCollege);


        // Modify Parent Contribution based on months of enrollment
        if ($args->MonthsOfEnrollment < self::DefaultMonthsOfEnrollment)
        {
            // LESS than default months of enrollment
            $parentMonthlyContribution = EfcMathHelper::round($parentContribution / self::DefaultMonthsOfEnrollment);
            $parentContribution = EfcMathHelper::round($parentMonthlyContribution * $args->MonthsOfEnrollment);
        }
        else if ($args->MonthsOfEnrollment > self::DefaultMonthsOfEnrollment)
        {
            // MORE than default months of enrollment
            $parentAltAai
                = $parentAdjustedAvailableIncome + $this->_constants->AltEnrollmentIncomeProtectionAllowance;

            $parentAltContributionFromAai
                = $this->_aaiContributionCalculator->calculateContributionFromAai(EfcCalculationRole::Parent, $parentAltAai);

            $parentAltContribution
                = EfcMathHelper::round($parentAltContributionFromAai / $args->NumberInCollege);

            $parentContributionDiff
                = ($parentAltContribution - $parentContribution);

            $parentMonthlyContribution
                = EfcMathHelper::round($parentContributionDiff / self::AnnualMonthsOfEnrollment);

            $parentContributionAdjustment
                = EfcMathHelper::round($parentMonthlyContribution * ($args->MonthsOfEnrollment - self::DefaultMonthsOfEnrollment));

            $parentContribution += $parentContributionAdjustment;
        }

        // Student's Total Income
        $studentTotalIncome = $this->_incomeCalculator->calculateTotalIncome(
                                        $args->studentAdjustedGrossIncome,
                                        $args->student->workIncome,
                                        $args->IsStudentTaxFiler,
                                        $args->studentUntaxedIncomeAndBenefits,
                                        $args->studentAdditionalFinancialInfo);

        // Student's Total Allowances
        $studentTotalAllowances = $this->_allowanceCalculator->calculateTotalAllowances(
                                        EfcCalculationRole::DependentStudent,
                                        MaritalStatus::SingleSeparatedDivorced,
                                        $args->StateOfResidency,
                                        $args->NumberInCollege,
                                        $args->NumberInHousehold,
                                        array($args->student),
                                        $studentTotalIncome,
                                        $args->studentIncomeTaxPaid);

        // If parent has a negative AAI, add it to the student's Total Allowances
        if ($parentAdjustedAvailableIncome < 0)
        {
            $studentTotalAllowances -= $parentAdjustedAvailableIncome;
        }

        // Student's Available Income (Contribution From Available Income)
        $studentAvailableIncome = $this->_incomeCalculator->calculateAvailableIncome(
            							EfcCalculationRole::DependentStudent,
            							$studentTotalIncome,
            							$studentTotalAllowances);

        // Modify Student's Available Income based on months of enrollment
        if ($args->MonthsOfEnrollment < self::DefaultMonthsOfEnrollment)
        {
            // LESS than default months of enrollment
            $studentMonthlyContribution = EfcMathHelper::round($studentAvailableIncome / self::DefaultMonthsOfEnrollment);
            $studentAvailableIncome = EfcMathHelper::round($studentMonthlyContribution * $args->MonthsOfEnrollment);
        }

		// For MORE than default months of enrollment, the standard Available Income is used

        // Student's Contribution From Assets
        $studentAssetContribution = 0;

        if (!$useSimplified)
        {
            $studentAssetContribution = $this->_assetContributionCalculator->calculateContributionFromAssets(
                						EfcCalculationRole::DependentStudent,
                						MaritalStatus::SingleSeparatedDivorced,
                						0,
						                $args->studentCashSavingsChecking,
						                $args->studentInvestmentNetWorth,
						                $args->studentBusinessFarmNetWorth);
        }

		// Student Contribution
        $studentContribution = $studentAvailableIncome + $studentAssetContribution;

        $profile = new EfcProfile(
        				$parentContribution + $studentContribution, 
        				$parentContribution,
        				$studentContribution,
        				$parentTotalIncome);

        return $profile;
	}

	/**
	 * Calculates student contribution (SC) and expected family contribution (EFC) for an independent student
	 * @param IndependentEfcCalculatorArguments $args Parameters for the calculation
	 * @return EfcProfile
	 */
	public function getIndependentEfcProfile($args)
	{
        if ($args->NumberInCollege <= 0
                || $args->MonthsOfEnrollment <= 0
                || $args->student == null)
        {
            return new EfcProfile(0, 0, 0, 0);
        }

        $role = ($args->HasDependents)
                      ? EfcCalculationRole::IndependentStudentWithDependents
                      : EfcCalculationRole::IndependentStudentWithoutDependents;

        $workIncome = 0;

        $householdMembers = array($args->student);
        $workIncome += $args->student->isWorking ? $args->student->workIncome : 0;

        if ($args->spouse != null)
        {
            if ($args->spouse->isWorking)
            {
                $workIncome += $args->spouse->workIncome;
            }

            $householdMembers.Add($args->student);
        }

        $simpleIncome = ($args->AreTaxFilers) ? $args->AdjustedGrossIncome : $workIncome;

        // Determine Auto Zero EFC eligibility
        if ($args->isQualifiedForSimplified
            && $role == EfcCalculationRole::IndependentStudentWithDependents
            && $simpleIncome <= $this->_constants->AutoZeroEfcMax)
        {
            return new EfcProfile(0, 0, 0, 0);
        }

        // Student's Total Income
        $totalIncome = $this->_incomeCalculator->calculateTotalIncome(
                                $args->AdjustedGrossIncome,
                                $workIncome,
                                $args->AreTaxFilers,
                                $args->UntaxedIncomeAndBenefits,
                                $args->AdditionalFinancialInfo);

        // Student's Total Allowances
        $totalAllowances = $this->_allowanceCalculator->calculateTotalAllowances(
                                    $role,
                                    $args->MaritalStatus,
                                    $args->StateOfResidency,
                                    $args->NumberInCollege,
                                    $args->NumberInHousehold,
                                    $householdMembers,
                                    $totalIncome,
                                    $args->IncomeTaxPaid);

        // Student's Available Income (Contribution from Available Income)
        $availableIncome = $this->_incomeCalculator->calculateAvailableIncome(role, totalIncome, totalAllowances);

        // Determine Simplified EFC Equation Eligibility
        $useSimplified = ($args->isQualifiedForSimplified && $simpleIncome <= $this->_constants->SimplifiedEfcMax);

        // Student's Contribution From Assets
        $assetContribution = 0;

        if (!$useSimplified)
        {
            $assetContribution = $this->_assetContributionCalculator->calculateContributionFromAssets(
                $role,
                $args->maritalStatus,
                $args->age,
                $args->cashSavingsCheckings,
                $args->investmentNetWorth,
                $args->businessFarmNetWorth);
        }

        // Student's Adjusted Available Income
        $adjustedAvailableIncome = $availableIncome + $assetContribution;

        // Student Contribution From AAI
        $studentContributionFromAai
            = $this->_aaiContributionCalculator->calculateContributionFromAai($role, $adjustedAvailableIncome);

        // Student's Contribution
        $studentContribution = EfcMathHelper::round($studentContributionFromAai / $args->NumberInCollege);

        // Modify Student's Available Income based on months of enrollment
        if ($args->MonthsOfEnrollment < self::DefaultMonthsOfEnrollment)
        {
            // LESS than default months of enrollment
            $monthlyContribution = EfcMathHelper::round(studentContribution / self::DefaultMonthsOfEnrollment);
            $studentContribution = $monthlyContribution * $args->MonthsOfEnrollment;
        }

        // For MORE than default months of enrollment, the standard contribution is used

        $profile = new EfcProfile($studentContribution, 0, $studentContribution, 0);
        return $profile;
	}
}
?>