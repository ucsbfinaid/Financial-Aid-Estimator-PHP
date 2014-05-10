<?php
namespace Ucsb\Sa\FinAid\AidEstimation\EfcCalculation;

/**
 * @package Ucsb\Sa\FinAid\AidEstimation\EfcCalculation
 */
class EfcProfile
{
	/**
	 * @var float
	 */
    public $expectedFamilyContribution;

	/**
	 * @var float
	 */
    public $parentContribution;

	/**
	 * @var float
	 */
    public $studentContribution;

	/**
	 * @var float
	 */
    public $parentTotalIncome;

	public function __construct($efc, $pc, $sc, $parentTotalIncome)
	{
		$this->expectedFamilyContribution = $efc;
		$this->parentContribution = $pc;
		$this->studentContribution = $sc;
		$this->parentTotalIncome = $parentTotalIncome;
	}
}
?>