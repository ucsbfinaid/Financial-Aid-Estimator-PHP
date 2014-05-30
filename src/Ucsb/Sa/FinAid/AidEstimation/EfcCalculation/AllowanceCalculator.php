<?php
namespace Ucsb\Sa\FinAid\AidEstimation\EfcCalculation;

use Ucsb\Sa\FinAid\AidEstimation\Utility\EfcMathHelper;

/**
 * Total Allowances calculator
 * @package Ucsb\Sa\FinAid\AidEstimation\EfcCalculation
 */
class AllowanceCalculator
{
	private $_constants;

	/**
	 * Constructs a new Total Allowances calculator
	 * @param AllowanceCalculatorConstants $constants Constants used in the calculation of Total Allowances
	 */
	public function __construct($constants)
	{
		$this->_constants = $constants;
	}

	/**
	 * Calculates Total Allowances
	 * @param EfcCalculationRole $role Subject's role within the calculation
	 * @param MaritalStatus $maritalStatus Marital status
	 * @param UnitedStatesStateOrTerritory $stateOfResidency State of residency
	 * @param int $numInCollege Number in college
	 * @param int $numInHousehold Number in household
	 * @param HouseholdMember[] $employablePersons People capable of employment. Exact definition varies depending on role. If the role is "Parent"
	 * for example, this refers to the parents. If the role is "IndependentStudent", this refers to the student and spouse
	 * @param float $totalIncome Total Income
	 * @param float $incomeTaxPaid U.S. income tax paid
	 * @return float
	 */
	public function calculateTotalAllowances
			(
				$role, $maritalStatus, $stateOfResidency,
				$numInCollege, $numInHousehold, $employablePersons,
				$totalIncome, $incomeTaxPaid
			)
	{
		$totalAllowances = 0;

		// Income Tax Paid
		$totalAllowances += $this->calculateIncomeTaxAllowance($incomeTaxPaid);

        // State Tax
        $totalAllowances += $this->calculateStateTaxAllowance($role, $stateOfResidency, $totalIncome);

        // Social Security Tax
        foreach ($employablePersons as $person)
        {
        	if($person->isWorking)
        	{
        		$totalAllowances += $this->CalculateSocialSecurityTaxAllowance($person->workIncome);
        	}
        }

        // Employment Expense Allowance
		if ($role != EfcCalculationRole::DependentStudent)
		{
		    $totalAllowances += $this->calculateEmploymentExpenseAllowance($role, $maritalStatus, $employablePersons);
		}

        // Income Protection Allowance
        $totalAllowances += $this->calculateIncomeProtectionAllowance($role, $maritalStatus, $numInCollege, $numInHousehold);

        return $totalAllowances;
	}

	/**
	 * Calculates Income Tax Paid allowance
	 * @param $incomeTaxPaid U.S. income tax paid
	 * @return float
	 */
	public function calculateIncomeTaxAllowance($incomeTaxPaid)
	{
		return EfcMathHelper::roundPositive($incomeTaxPaid);
	}

	/**
	 * Calculates State and Other Tax allowance
	 * @param EfcCalculationRole $role Subject's role within the calculation
	 * @param UnitedStatesStateOrTerritory $stateOfResidency State of residency
	 * @param float $totalIncome Total Income
	 * @return float
	 */
	public function calculateStateTaxAllowance($role, $stateOfResidency, $totalIncome)
	{
		if(!$stateOfResidency)
		{
			$stateOfResidency = UnitedStatesStateOrTerritory::Other;
		}

		$stateTaxAllowance = 0;

		$stateTaxAllowanceIncomeThreshold = $this->_constants->stateTaxAllowanceIncomeThreshold;
		$parentStateTaxAllowancePercents = $this->_constants->parentStateTaxAllowancePercents;
		$studentStateTaxAllowancePercents = $this->_constants->studentStateTaxAllowancePercents;

		$percentage = 0;

		switch($role)
		{
	        // For Parents and Independent Students With Dependents, use the "Parent" State Tax Allowance chart
	        case EfcCalculationRole::Parent:
	        case EfcCalculationRole::IndependentStudentWithDependents:
	        	$percentage = ($totalIncome < $stateTaxAllowanceIncomeThreshold)
	        		? $parentStateTaxAllowancePercents[$stateOfResidency]
	        		: $parentStateTaxAllowancePercents[$stateOfResidency] - 1;
	            break;

	        // For Dependent Students and Independent Students Without Dependents, use the "Student" State Tax Allowance chart
	        case EfcCalculationRole::DependentStudent:
	        case EfcCalculationRole::IndependentStudentWithoutDependents:
	            $percentage = $studentStateTaxAllowancePercents[$stateOfResidency];
	            break;
		}

		$stateTaxAllowance = ($percentage * 0.01) * $totalIncome;
		return EfcMathHelper::roundPositive($stateTaxAllowance);
	}

	/**
	 * Calculates Social Security Tax allowance
	 * @param float $workIncome Income earned from work 
	 * @return float
	 */
	public function calculateSocialSecurityTaxAllowance($workIncome)
	{
		$socialSecurityTaxAllowance = 0;

		$socialSecurityTaxIncomeThreshold = $this->_constants->socialSecurityTaxIncomeThreshold;
		$socialSecurityLowPercent = $this->_constants->socialSecurityLowPercent;
		$socialSecurityHighPercent = $this->_constants->socialSecurityHighPercent;
		$socialSecurityHighBase = $this->_constants->socialSecurityHighBase;

	    if ($workIncome > $socialSecurityTaxIncomeThreshold)
	    {
	        $socialSecurityTaxAllowance =
	        	(($workIncome - $socialSecurityTaxIncomeThreshold) * $socialSecurityHighPercent)
	        	+ $socialSecurityHighBase;
	    }
	    else
	    {
	        $socialSecurityTaxAllowance = ($socialSecurityLowPercent * $workIncome);
	    }

	    return EfcMathHelper::roundPositive($socialSecurityTaxAllowance);
	}

	/**
	 * Calculates Income Protection Allowance
	 * @param EfcCalculationRole $role Subject's role within the calculation
	 * @param MaritalStatus $maritalStatus Marital status
	 * @param int $numInCollege Number in college
	 * @param int $numInHousehold Number in household
	 * @return float
	 */
	public function calculateIncomeProtectionAllowance($role, $maritalStatus, $numInCollege, $numInHousehold)
	{
		if ($numInCollege > $numInHousehold || $numInCollege <= 0 || $numInHousehold <= 0)
		{
		    return 0;
		}

		$incomeProtectionAllowance = 0;

		$dependentParentIncomeProtectionAllowances
			= $this->_constants->dependentParentIncomeProtectionAllowances;
		$independentWithDependentsIncomeProtectionAllowances
			= $this->_constants->independentWithDependentsIncomeProtectionAllowances;

		$singleIndependentWithoutDependentsIncomeProtectionAllowance
			= $this->_constants->singleIndependentWithoutDependentsIncomeProtectionAllowance;
		$marriedIndependentWithoutDependentsIncomeProtectionAllowance
			= $this->_constants->marriedIndependentWithoutDependentsIncomeProtectionAllowance;

		$dependentStudentIncomeProtectionAllowance
			= $this->_constants->dependentStudentIncomeProtectionAllowance;

		$dependentAdditionalStudentAllowance = $this->_constants->dependentAdditionalStudentAllowance;
		$independentAdditionalStudentAllowance = $this->_constants->independentAdditionalStudentAllowance;

		$dependentAdditionalFamilyAllowance = $this->_constants->dependentAdditionalFamilyAllowance;
		$independentAdditionalFamilyAllowance = $this->_constants->independentAdditionalFamilyAllowance;

		switch ($role)
		{
		    case EfcCalculationRole::IndependentStudentWithDependents:
		    case EfcCalculationRole::Parent:

		        // Determine the appropriate charts to use for Income Protection Allowance values
		        $incomeProtectionAllowances = ($role == EfcCalculationRole::Parent)
		            ? $dependentParentIncomeProtectionAllowances
		            : $independentWithDependentsIncomeProtectionAllowances;

		        $additionalStudentAllowance = ($role == EfcCalculationRole::Parent)
		            ? $dependentAdditionalStudentAllowance
		            : $independentAdditionalStudentAllowance;

		        $additionalFamilyAllowance = ($role == EfcCalculationRole::Parent)
		            ? $dependentAdditionalFamilyAllowance
		            : $independentAdditionalFamilyAllowance;

		        // If number of children in the household exceeds table range, add additionalFamilyAllowance
		        // for each additional child
		        $maxHouseholdCount = count($incomeProtectionAllowances) - 1;
		        $householdCount = $numInHousehold;

		        if ($numInHousehold > $maxHouseholdCount)
		        {
		            // Set number in household to maximum table range
		            $householdCount = $maxHouseholdCount;
		            $incomeProtectionAllowance += ($numInHousehold - $maxHouseholdCount) * $additionalFamilyAllowance;
		        }

		        // If number of children in college exceeds table range, add additionalStudentAllowance
		        // for each additional child
		        $maxCollegeCount = count($incomeProtectionAllowances[$maxHouseholdCount]) - 1;
		        $collegeCount = $numInCollege;

		        if ($numInCollege > $maxCollegeCount)
		        {
		            // Set number in college to maximum table range
		            $collegeCount = $maxCollegeCount;
		            $incomeProtectionAllowance -= ($numInCollege - $maxCollegeCount) * $additionalStudentAllowance;
		        }

		        // Add standard incomeProtectionAllowance value
		        $incomeProtectionAllowance += $incomeProtectionAllowances[$householdCount][$collegeCount];

		        break;

		    case EfcCalculationRole::IndependentStudentWithoutDependents:

		        if ($maritalStatus == MaritalStatus::SingleSeparatedDivorced)
		        {
		            $incomeProtectionAllowance
		                = $singleIndependentWithoutDependentsIncomeProtectionAllowance;
		        }
		        else
		        {
		            // If spouse is enrolled at least 1/2 time, then use the Income Protection Allowance value
		            // for Single/Separated/Divorced
		            $incomeProtectionAllowance = ($numInCollege > 1)
		            	? $singleIndependentWithoutDependentsIncomeProtectionAllowance
						: $marriedIndependentWithoutDependentsIncomeProtectionAllowance;
		        }

		        break;

		    case EfcCalculationRole::DependentStudent:
		        $incomeProtectionAllowance = $dependentStudentIncomeProtectionAllowance;
		        break;
		}

		return EfcMathHelper::roundPositive($incomeProtectionAllowance);
	}

	/**
	 * Calculates Employmement Expense Allowance
	 * @param EfcCalculationRole $role Subject's role within the calculation
	 * @param MaritalStatus $maritalStatus Marital status
	 * @param HouseholdMember[] $employablePersons People capable of employment. Exact definition varies depending on role. If the role is "Parent"
	 * for example, this refers to the parents. If the role is "IndependentStudent", this refers to the student and spouse
	 * @return float
	 */
	public function calculateEmploymentExpenseAllowance($role, $maritalStatus, $employablePersons)
	{
	    if ($employablePersons == null
	    		|| count($employablePersons) == 0
	    		|| ($role == EfcCalculationRole::DependentStudent)
	    		|| ($role == EfcCalculationRole::IndependentStudentWithoutDependents && $maritalStatus == MaritalStatus::SingleSeparatedDivorced))
	    {
	        return 0;
	    }

	    // Determine if all employable persons are earning money
	    foreach($employablePersons as $person)
	    {
	    	if(!$person->isWorking)
	    	{
	    		// Not all of the employable persons are working
	    		return 0;
	    	}
	    }

	    // Determine the lowest income
	    $lowestIncomePerson = $employablePersons[0];
	    $lowestIncome = $lowestIncomePerson->workIncome;

	    foreach($employablePersons as $person)
	    {
	    	if($person->workIncome < $lowestIncome)
	    	{
	    		$lowestIncome = $person->workIncome;
	    	}
	    }

	    $employmentExpensePercent = $this->_constants->employmentExpensePercent;
	    $employmentExpenseMaximum = $this->_constants->employmentExpenseMaximum;

	    // Use the lowest of the incomes for the calculation
	    $adjustedLowestIncome = ($lowestIncome * $employmentExpensePercent);

		$employmentExpenseAllowance = $adjustedLowestIncome > $employmentExpenseMaximum
			? $employmentExpenseMaximum
			: $adjustedLowestIncome;

		return EfcMathHelper::roundPositive($employmentExpenseAllowance);
	}
}
?>