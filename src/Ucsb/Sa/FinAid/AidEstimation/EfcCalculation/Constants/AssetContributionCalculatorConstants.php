<?php
namespace Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\Constants;

/**
 * Constants used in the calculation of the Contribution from Adjusted Available Income (AAI)
 * @package Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\Constants
 */
class AssetContributionCalculatorConstants
{
	/**
	 * Asset conversion rate for a parent
	 * @var float
	 */
	public $dependentParentAssetRate;

    /**
     * Asset assessment rate for a student
     * @var float
     */
    public $dependentStudentAssetRate;

	/**
	 * Asset conversion rate for an Independent Student with Dependents
	 * @var float
	 */
	public $independentWithDependentsAssetRate;

	/**
	 * Asset conversion rate for an Independent Student without Dependents
	 * @var float
	 */
	public $independentWithoutDependentsAssetRate;

	/**
	 * Lowest age for the "Asset Protection Allowance" values
	 * @var int
	 */
	public $assetProtectionAllowanceLowestAge;

	/**
	 * "Asset Protection Allowance" values for married persons
	 * @var int[]
	 */
	public $marriedAssetProtectionAllowances;

	/**
	 * "Asset Protection Allowance" values for single persons
	 * @var int[]
	 */
	public $singleAssetProtectionAllowances;

	/**
	 * Ranges used in calculating "Adjusted net worth of business/farm"\
	 * @var int[]
	 */
	public $businessFarmNetWorthAdjustmentRanges;

	/**
	 * Base values used in calculating "Adjusted net worth of business/farm"
	 * @var int[]
	 */
	public $businessFarmNetWorthAdjustmentBases;

	/**
	 * Percentages used in calculating "Adjusted net worth of business/farm"
	 * @var float[]
	 */
	public $businessFarmNetWorthAdjustmentPercents;
}
?>