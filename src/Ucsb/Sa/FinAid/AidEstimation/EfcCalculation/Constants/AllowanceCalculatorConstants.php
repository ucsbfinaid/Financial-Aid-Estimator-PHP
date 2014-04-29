<?php
namespace Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\Constants;

/**
 * Constants used in the calculation of Total Allowances
 * @package Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\Constants
 */
class AllowanceCalculatorConstants
{
	/**
	 * Threshold value used in determining a State and Other Tax Allowance percentage
	 * @var int
	 */
    public $stateTaxAllowanceIncomeThreshold;

    /**
     * State and Other Tax Allowance percentage values for Parents and Independent Students with Dependents
     * @var int[]
     */
    public $parentStateTaxAllowancePercents;

    /**
     * State and Other Tax Allowance percentage values for Students and Independent Students without Dependents
     * @var int[]
     */
    public $studentStateTaxAllowancePercents;

    /**
     * Threshold value used in determining the formula for Social Security Tax Allowance
     * @var int
     */
    public $socialSecurityTaxIncomeThreshold;

 	/**
 	 * Percentage used in formula for Social Security Tax Allowance for incomes below the threshold
 	 * @var float
 	 */
    public $socialSecurityLowPercent;

    /**
     * Percentage used in formula for Social Security Tax Allowance for incomes above the threshold
     * @var float
     */
    public $socialSecurityHighPercent;

    /**
     * Base value used in formula for Social Security Tax Allowance for incomes above the threshold
     * @var float
     */
    public $socialSecurityHighBase;

    /**
     * Percentage used in calculating Employment Expense Allowance
     * @var float
     */
    public $employmentExpensePercent;

    /**
     * Maximum Employment Expense Allowance value
     * @var float
     */
    public $employmentExpenseMaximum;

    /**
     * Income Protection Allowance values for Parents
     * @var int[][]
     */ 
    public $dependentParentIncomeProtectionAllowances;

    /**
     * Income Protection Allowance values for Independents with Dependents
     * @var int[][]
     */
    public $independentWithDependentsIncomeProtectionAllowances;

    /**
     * Value subtracted for additional Number in College when calculating Income Protection Allowance values
     * for Parents
     * @var int
     */
    public $dependentAdditionalStudentAllowance;

    /**
     * Value added for additional Number in Household when calculating Income Protection Allowance values
     * for Parents
     * @var int
     */
    public $dependentAdditionalFamilyAllowance;

    /**
     * Value subtracted for additional Number in College when calculating Income Protection Allowance values
     * for Independents with Dependents
     * @var int
     */
    public $independentAdditionalStudentAllowance;

    /**
     * Value added for additional Number in Household when calculating Income Protection Allowance values
     * for Independents with Dependents
     * @var int
     */
    public $independentAdditionalFamilyAllowance;

    /**
     * Income Protection Allowance for a single Independent without Dependents
     * @var int
     */
    public $singleIndependentWithoutDependentsIncomeProtectionAllowance;

    /**
     * Income Protection Allowance for a married Independent without Dependents
     * @var int
     */
    public $marriedIndependentWithoutDependentsIncomeProtectionAllowance;

    /**
     * Income Protection Allowance for a Dependent Student
     * @var int
     */
    public $dependentStudentIncomeProtectionAllowance;
}
?>