<?php
namespace Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\Constants;

/**
 * Constants used in the calculation of the Contribution from Adjusted Available Income (AAI)
 * @package Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\Constants
 */
class AaiContributionCalculatorConstants
{
	/**
	 * Adjusted Available Income (AAI) ranges
	 * @var integer[]
	 */
	public $aaiContributionRanges;

	/**
	 * Adjusted Available Income (AAI) base values
	 * @var float[]
	 */
	public $aaiContributionBases;

	/**
	 * Adjusted Available Income (AAI) percentages
	 * @var float[]
	 */
	public $aaiContributionPercents;
}
?>