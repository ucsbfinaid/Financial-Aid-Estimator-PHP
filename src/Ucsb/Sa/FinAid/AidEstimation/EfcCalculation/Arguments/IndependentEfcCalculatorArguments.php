<?php
namespace Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\Arguments;

/**
 * Parameters used in the calculation of an independent student's Expected Family Contribution (EFC)
 * @package Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\Arguments
 */
class IndependentEfcCalculatorArguments
{
	/**
	 * Student
	 * @var HouseholdMember
	 */
	public $student;

	/**
	 * Spouse
	 * @var HouseholdMember
	 */
	public $spouse;

	/**
	 * Student and Spouse's Adjusted Gross Income (AGI)
	 * @var float
	 */
	public $adjustedGrossIncome;

	/**
	 * Whether or not the student or spouse is required to file taxes
	 * @var boolean
	 */
	public $areTaxFilers;

	/**
	 * Student and spouse's U.S. income tax paid
	 * @var float
	 */
	public $incomeTaxPaid;

	/**
	 * Student and spouse's total untaxed income and benefits
	 * @var float
	 */
	public $untaxedIncomeAndBenefits;

	/**
	 * Student and spouse's total additional financial information
	 * @var float
	 */
	public $additionalFinancialInfo;

	/**
	 * Student and spouse's total cash, savings, and checkings
	 * @var float
	 */
	public $cashSavingsCheckings;

	/**
	 * Student and spouse's net worth of investments
	 * @var float
	 */
	public $investmentNetWorth;

	/**
	 * Student and spouse's net worth of business and/or investment farm
	 * @var float
	 */
	public $businessFarmNetWorth;

	/**
	 * Whether or not the student has dependents
	 * @var boolean
	 */
	public $hasDependents;

	/**
	 * Student's marital status
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
	 * Age of the student
	 * @var int
	 */
	public $age;

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