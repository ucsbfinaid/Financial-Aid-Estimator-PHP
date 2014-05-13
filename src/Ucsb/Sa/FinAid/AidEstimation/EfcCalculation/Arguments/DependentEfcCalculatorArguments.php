<?php
namespace Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\Arguments;

/**
 * Parameters used in the calculation of a dependent student's Expected Family Contribution (EFC)
 * @package Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\Arguments
 */
class DependentEfcCalculatorArguments
{
	/**
	 * First parent
	 * @var HouseholdMember
	 */
	public $firstParent;

	/**
	 * Second parent
	 * @var HouseholdMember
	 */
	public $secondParent;

	/**
	 * Student
	 * @var HouseholdMember
	 */
	public $student;

	/**
	 * Parent's Adjusted Gross Income (AGI)
	 * @var float
	 */
	public $parentAdjustedGrossIncome;

	/**
	 * Whether or not the parents are required to file taxes
	 * @var boolean
	 */
	public $areParentsTaxFilers;

	/**
	 * Parent's U.S. income tax paid
	 * @var float
	 */
	public $parentIncomeTaxPaid;

	/**
	 * Parent's total untaxed income and benefits
	 * @var float
	 */
	public $parentUntaxedIncomeAndBenefits;

	/**
	 * Parent's total additional financial information
	 * @var float
	 */
	public $parentAdditionalFinancialInfo;

	/**
	 * Student's Adjusted Gross Income (AGI)
	 * @var float
	 *
	 */
	public $studentAdjustedGrossIncome;

	/**
	 * Whether or not the student is required to file taxes
	 * @var boolean
	 */
	public $isStudentTaxFiler;

	/**
	 * Student's U.S. income tax paid
	 * @var float
	 */
	public $studentIncomeTaxPaid;

	/**
	 * Student's total untaxed income and benefits
	 * @var float
	 */
	public $studentUntaxedIncomeAndBenefits;

	/**
	 * Student's total additional financial information
	 * @var float
	 */
	public $studentAdditionalFinancialInfo;

	/**
	 * Parent's total cash, savings, and checkings
	 * @var float
	 */
	public $parentCashSavingsChecking;

	/**
	 * Parent's net worth of investments
	 * @var float
	 */
	public $parentInvestmentNetWorth;

	/**
	 * Parent's net worth of business and/or investment farm
	 * @var float
	 */
	public $parentBusinessFarmNetWorth;

	/**
	 * Student's total cash, savings, and checking
	 * @var float
	 */
	public $studentCashSavingsChecking;

	/**
	 * Student's net worth of investments
	 * @var float
	 */
	public $studentInvestmentNetWorth;

	/**
	 * Student's net worth of business and/or investment farm
	 * @var float
	 */
	public $studentBusinessFarmNetWorth;

	/**
	 * Parent's marital status
	 * @var MaritalStatus
	 */
	public $maritalStatus;

	/**
	 * Student's state of residency
	 * @var UnitedStatesStateOrTerritory
	 */
	public $stateOfResidency;

	/**
	 * Number in the household
	 * @var int
	 */
	public $numberInHousehold;

	/**
	 * Number of people in the household that are in college
	 * @var int
	 */
	public $numberInCollege;

	/**
	 * Age of the oldest parent
	 * @var int
	 */
	public $oldestParentAge;

	/**
	 * Whether or not the student qualifies for the simplified EFC calculation
	 * @var boolean
	 */
	public $isQualifiedForSimplified;

	/**
	 * Months that student will be enrolled in college
	 * @var int
	 */
	public $monthsOfEnrollment;
}
?>