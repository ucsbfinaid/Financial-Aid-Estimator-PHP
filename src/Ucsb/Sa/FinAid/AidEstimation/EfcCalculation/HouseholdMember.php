<?php
namespace Ucsb\Sa\FinAid\AidEstimation\EfcCalculation;

/**
 * Represents a person within a household
 * @package Ucsb\Sa\FinAid\AidEstimation\EfcCalculatio
 */
class HouseholdMember
{
	/**
	 * Income earned from work
	 * @var float
	 */
	public $workIncome;

	/**
	 * Whether or not the person is currently working
	 * @var boolean
	 */
	public $isWorking;
}
?>