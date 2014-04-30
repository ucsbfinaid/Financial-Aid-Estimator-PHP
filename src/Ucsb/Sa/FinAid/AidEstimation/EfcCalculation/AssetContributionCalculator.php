<?php
namespace Ucsb\Sa\FinAid\AidEstimation\EfcCalculation;

use Ucsb\Sa\FinAid\AidEstimation\Utility\EfcMathHelper;

/**
 * Contribution From Assets calculator
 * @package Ucsb\Sa\FinAid\AidEstimation\EfcCalculation
 */
class AssetContributionCalculator
{
	private $_constants;

	/**
	 * Constructs a new Contribution From Assets calculator
	 * @param AssetContributionCalculatorConstants $constants Constants used in the calculation of Contribution From Assets
	 */
	public function __construct($constants)
	{
		$this->_constants = $constants;
	}

	/**
	 * Calculates Contribution From Assets
	 * @param EfcCalculationRole $role Subject's role within the calculation
	 * @param MaritalStatus $maritalStatus Marital status
	 * @param int $age Age
	 * @param float $cashSavingsCheckings Cash, savings, and checkings value
	 * @param float $investmentNetWorth Net worth of investments
	 * @param float $businessFarmNetWorth Net worth of business and/or investment farm
	 * @return float
	 */
    public function calculateContributionFromAssets
    	(
	    	$role, $maritalStatus, $age,
	    	$cashSavingsCheckings, $investmentNetWorth, $businessFarmNetWorth
    	)
    {
        $contributionFromAssets = 0;

        if ($role == EfcCalculationRole::DependentStudent)
        {
            $contributionFromAssets
                += $this->calculateNetWorth($role, $cashSavingsCheckings, $investmentNetWorth, $businessFarmNetWorth);
        }
        else
        {
            $contributionFromAssets
                += $this->calculateDiscretionaryNetWorth($role, $maritalStatus, $age, $cashSavingsCheckings,
                											$investmentNetWorth, $businessFarmNetWorth);
        }

        $assetRate = 1;

        switch ($role)
        {
            case EfcCalculationRole::Parent:
                $assetRate = $this->_constants->dependentParentAssetRate;
                break;

            case EfcCalculationRole::DependentStudent:
                $assetRate = $this->_constants->dependentStudentAssetRate;
                break;

            case EfcCalculationRole::IndependentStudentWithDependents:
                $assetRate = $this->_constants->independentWithDependentsAssetRate;
                break;

            case EfcCalculationRole::IndependentStudentWithoutDependents:
                $assetRate = $this->_constants->independentWithoutDependentsAssetRate;
                break;
        }

        $contributionFromAssets *= $assetRate;

        return EfcMathHelper::roundPositive($contributionFromAssets);
    }

	/**
	 * Calculates Discretionary Net Worth contribution
	 * @param EfcCalculationRole $role Subject's role within the calculation
	 * @param MaritalStatus $maritalStatus Marital status
	 * @param int $age Age
	 * @param float $cashSavingsCheckings Cash, savings, and checkings value
	 * @param float $investmentNetWorth Net worth of investments
	 * @param float $businessFarmNetWorth Net worth of business and/or investment farm
	 * @return float
	 */
	public function calculateDiscretionaryNetWorth
		(
            $role, $maritalStatus, $age,
            $cashSavingsCheckings, $investmentNetWorth, $businessFarmNetWorth
		)
    {
        $discretionaryNetWorth = 0;

        $discretionaryNetWorth +=
            $this->calculateNetWorth($role, $cashSavingsCheckings, $investmentNetWorth, $businessFarmNetWorth);

        $discretionaryNetWorth -=
            $this->calculateAssetProtectionAllowance($maritalStatus, $age);

        return EfcMathHelper::round($discretionaryNetWorth);
    }

	/**
	 * Calculates Net Worth contribution
	 * @param EfcCalculationRole $role Subject's role within the calculation
	 * @param float $cashSavingsCheckings Cash, savings, and checkings value
	 * @param float $investmentNetWorth Net worth of investments
	 * @param float $businessFarmNetWorth Net worth of business and/or investment farm
	 * @return float
	 */
	public function calculateNetWorth($role, $cashSavingsCheckings, $investmentNetWorth, $businessFarmNetWorth)
    {
        $netWorth = 0;

        $netWorth += $this->calculateCashSavingsCheckingsContribution($cashSavingsCheckings);
        $netWorth += $this->calculateInvestmentNetWorthContribution($investmentNetWorth);
        $netWorth += $this->calculateAdjustedBusinessFarmNetWorthContribution($role, $businessFarmNetWorth);

        return EfcMathHelper::roundPositive($netWorth);
    }

	/**
	 * Calculates Cash, savings, and checkings contribution
	 * @param float $cashSavingsCheckings Cash, savings, and checkings value
	 * @return float
	 */
	public function calculateCashSavingsCheckingsContribution($cashSavingsCheckings)
	{
		return EfcMathHelper::roundPositive($cashSavingsCheckings);
	}

	/**
	 * Calculates Net worth of investments contribution
	 * @param float $investmentNetWorth Net worth of investments
	 * @return float
	 */
	public function calculateInvestmentNetWorthContribution($investmentNetWorth)
    {
    	return EfcMathHelper::roundPositive($investmentNetWorth);
    }

	/**
	 * Calculates the Adjusted Net Worth of Business/Farm contribution
	 * @param EfcCalculationRole $role Subject's role within the calculation
	 * @param float $businessFarmNetWorth Net worth of business and/or investment farm
	 * @return float
	 */
    public function calculateAdjustedBusinessFarmNetWorthContribution($role, $businessFarmNetWorth)
    {
        if ($role == EfcCalculationRole::DependentStudent)
        {
        	return EfcMathHelper::roundPositive($businessFarmNetWorth);
        }

        $businessFarmNetWorthAdjustmentRanges = $this->_constants->businessFarmNetWorthAdjustmentRanges;
        $businessFarmNetWorthAdjustmentBases = $this->_constants->businessFarmNetWorthAdjustmentBases;
        $businessFarmNetWorthAdjustmentPercents = $this->_constants->businessFarmNetWorthAdjustmentPercents;

        $baseRange = 0;
        $maxIndex = count($businessFarmNetWorthAdjustmentRanges) - 1;

        // Loop through $businessFarmNetWorthAdjustmentContributionRanges until $businessFarmNetWorth
        // param is within range
        foreach($businessFarmNetWorthAdjustmentRanges as $index => $range)
        {
            // If at end of ranges, set baseAmount to maximum range
            if ($index == $maxIndex)
            {
                $baseRange = $businessFarmNetWorthAdjustmentRanges[$index];
                break;
            }

            // If businessFarmNetWorth is within range
            if ($businessFarmNetWorth < $businessFarmNetWorthAdjustmentRanges[$index + 1])
            {
                // If $businessFarmNetWorth is within first range, there is no baseAmount
                // Otherwise, assign standard baseAmount
                $baseRange = ($index == 0) ? 0 : $range;
                break;
            }
        }

        // Contribution From AAI = 
        //      (Base Amount for Range)
        //          + (((Business Farm Net Worth) - (Lowest Value of Range)) * (Percent for Range))
        $adjustedBusinessFarmNetWorth =
            $businessFarmNetWorthAdjustmentBases[$index]
                + (($businessFarmNetWorth - $baseRange) * ($businessFarmNetWorthAdjustmentPercents[$index] * 0.01));

		return EfcMathHelper::roundPositive($adjustedBusinessFarmNetWorth);
    }

    /**
     * Calculates Asset Protection Allowance
	 * @param MaritalStatus $maritalStatus Marital status
	 * @param int $age Age
	 * @return float
	 */
    public function calculateAssetProtectionAllowance($maritalStatus, $age)
    {
    	$assetProtectionAllowanceLowestAge = $this->_constants->assetProtectionAllowanceLowestAge;
    	$marriedAssetProtectionAllowances = $this->_constants->marriedAssetProtectionAllowances;
    	$singleAssetProtectionAllowances = $this->_constants->singleAssetProtectionAllowances;

        if ($age < $assetProtectionAllowanceLowestAge)
        {
            return 0;
        }

        $assetProtectionAllowances =
            ($maritalStatus == MaritalStatus::MarriedRemarried)
                ? $marriedAssetProtectionAllowances
                : $singleAssetProtectionAllowances;

        $maxIndex = count($assetProtectionAllowances) - 1;

        if ($age > ($assetProtectionAllowanceLowestAge + $maxIndex))
        {
            return $assetProtectionAllowances[$maxIndex];
        }

        return $assetProtectionAllowances[$age - $assetProtectionAllowanceLowestAge];
    }
}
?>