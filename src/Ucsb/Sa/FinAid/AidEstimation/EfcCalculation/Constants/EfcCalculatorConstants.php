<?php
namespace Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\Constants;

class EfcCalculatorConstants
{
	/**
	 * Maximum income to qualify for the Simplified EFC formula
	 * @var int
	 */
	public $simplifiedEfcMax;

	/**
	 * Maximum income to qualify for the Auto Zero EFC formula
	 * @var int
	 */
	public $autoZeroEfcMax;

	/**
	 * The difference between the income protection allowance for a family of four and a family of five,
	 * with one in college (used in the calculation of EFC for months of enrollment greater than the standard
	 * months of enrollment)
	 * @var int
	 */
	public $altEnrollmentIncomeProtectionAllowance;
}
?>