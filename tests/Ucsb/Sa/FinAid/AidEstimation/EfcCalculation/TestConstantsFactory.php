<?php
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\Constants\AaiContributionCalculatorConstants;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\Constants\AllowanceCalculatorConstants;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\Constants\AssetContributionCalculatorConstants;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\Constants\EfcCalculatorConstants;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\Constants\IncomeCalculatorConstants;

class TestConstantsFactory
{
	public static function getAaiContributionCalculatorConstants()
	{
		$constants = new AaiContributionCalculatorConstants();

        $constants->aaiContributionBases = array(0, 3740, 4840, 6087, 7583, 9343);
        $constants->aaiContributionPercents = array(22, 25, 29, 34, 40, 47);
        $constants->aaiContributionRanges = array(-3409, 17000, 21400, 25700, 30100, 34500);

        return $constants;
	}

	public static function getAllowanceCalculatorConstants()
	{
		$constants = new AllowanceCalculatorConstants();

		$constants->stateTaxAllowanceIncomeThreshold = 15000;

        $constants->parentStateTaxAllowancePercents = array(
            3, // Other
            3, // Alabama
            2, // Alaska
            3, // American Samoa
            4, // Arizona
            4, // Arkansas
            8, // Calfornia
            3, // Canada and Canadian Provinces
            4, // Colorado
            9, // Connecticut
            5, // Delaware
            7, // District of Columbia
            3, // Federated States of Micronesia
            3, // Florida
            5, // Georgia
            3, // Guam
            5, // Hawaii
            5, // Idaho
            5, // Illinois
            4, // Indiana
            5, // Iowa
            4, // Kansas
            5, // Kentucky
            3, // Louisiana
            6, // Maine
            3, // Marshall Islands
            8, // Maryland
            7, // Massachusetts
            3, // Mexico
            4, // Michigan
            6, // Minnesota
            3, // Mississippi
            5, // Missouri
            5, // Montana
            5, // Nebraska
            2, // Nevada
            4, // New Hampshire
            9, // New Jersey
            3, // New Mexico
            9, // New York
            5, // North Carolina
            2, // North Dakota
            3, // Northern Mariana Islands
            5, // Ohio
            3, // Oklahoma
            7, // Oregon
            3, // Palau
            5, // Pennsylvania
            3, // Puerto Rico
            6, // Rhode Island
            4, // South Carolina
            2, // South Dakota
            2, // Tennessee
            3, // Texas
            5, // Utah
            6, // Vermont
            3, // Virgin Islands
            6, // Virginia
            3, // Washington
            3, // West Virginia
            6, // Wisconsin
            2  // Wyoming
        );

        $constants->studentStateTaxAllowancePercents = array(
            2, // Other
            2, // Alabama
            0, // Alaska
            2, // American Samoa
            2, // Arizona
            3, // Arkansas
            6, // California
            2, // Canada and Canadian Provinces
            3, // Colorado
            5, // Connecticut
            3, // Delaware
            6, // District of Columbia
            2, // Federated States of Micronesia
            1, // Florida
            3, // Georgia
            2, // Guam
            4, // Hawaii
            3, // Idaho
            3, // Illinois
            3, // Indiana
            3, // Iowa
            2, // Kansas
            4, // Kentucky
            2, // Louisiana
            3, // Maine
            2, // Marshall Islands
            6, // Maryland
            4, // Massachusetts
            2, // Mexico
            3, // Michigan
            5, // Minnesota
            2, // Mississippi
            3, // Missouri
            3, // Montana
            3, // Nebraska
            1, // Nevada
            1, // New Hampshire
            5, // New Jersey
            2, // New Mexico
            7, // New York
            3, // North Carolina
            1, // North Dakota
            2, // Northern Mariana Islands
            3, // Ohio
            2, // Oklahoma
            5, // Oregon
            2, // Palau
            3, // Pennsylvania
            2, // Puerto Rico
            3, // Rhode Island
            3, // South Carolina
            1, // South Dakota
            1, // Tennessee
            1, // Texas
            3, // Utah
            3, // Vermont
            2, // Virgin Islands
            4, // Virginia
            1, // Washington
            3, // West Virginia
            4, // Wisconsin
            1 // Wyoming
        );

        $constants->socialSecurityTaxIncomeThresholds = array(0, 128400, 200000);
        $constants->socialSecurityTaxPercentages = array(0.0765, 0.0145, 0.0235);
        $constants->socialSecurityTaxBases = array(0, 9822.60, 10860.80);

        $constants->employmentExpensePercent = 0.35;
        $constants->employmentExpenseMaximum = 4000;

        $constants->dependentParentIncomeProtectionAllowances = array(
            array( 0, 0, 0, 0, 0, 0 ),
            array( 0, 0, 0, 0, 0, 0 ),
            array( 0, 19080, 15810, 0, 0, 0 ),
            array( 0, 23760, 20510, 17250, 0, 0 ),
            array( 0, 29340, 26080, 22830, 19570, 0),
            array( 0, 34620, 31350, 28110, 24840, 21600 ),
            array( 0, 40490, 37230, 33980, 30720, 27470 )
        );

        $constants->independentWithDependentsIncomeProtectionAllowances = array(
            array( 0, 0, 0, 0, 0, 0 ),
            array( 0, 0, 0, 0, 0, 0 ),
            array( 0, 26940, 22340, 0, 0, 0 ),
            array( 0, 33550, 28960, 24360, 0, 0 ),
            array( 0, 41420, 36830, 32250, 27630, 0 ),
            array( 0, 48880, 44260, 39680, 35080, 30500 ),
            array( 0, 57160, 52560, 47990, 43360, 38790 )
        );

        $constants->dependentAdditionalStudentAllowance = 3250;
        $constants->dependentAdditionalFamilyAllowance = 4750;

        $constants->independentAdditionalStudentAllowance = 4580;
        $constants->independentAdditionalFamilyAllowance = 6450;

        $constants->dependentStudentIncomeProtectionAllowance = 6840;
        $constants->singleIndependentWithoutDependentsIncomeProtectionAllowance = 10640;
        $constants->marriedIndependentWithoutDependentsIncomeProtectionAllowance = 17060;

        return $constants;
	}

	public static function getAssetContributionCalculatorConstants()
	{
		$constants = new AssetContributionCalculatorConstants();

        $constants->dependentParentAssetRate = 0.12;
        $constants->dependentStudentAssetRate = 0.2;
        $constants->independentWithDependentsAssetRate = 0.07;
        $constants->independentWithoutDependentsAssetRate = 0.2;

        $constants->assetProtectionAllowanceLowestAge = 25;

        $constants->marriedAssetProtectionAllowances = array(
            0,
            300,
            700,
            1000,
            1300,
            1600,
            2000,
            2300,
            2600,
            2900,
            3300,
            3600,
            3900,
            4200,
            4600,
            4900,
            5100,
            5200,
            5300,
            5400,
            5500,
            5700,
            5800,
            6000,
            6100,
            6300,
            6400,
            6600,
            6800,
            6900,
            7100,
            7300,
            7500,
            7700,
            7900,
            8200,
            8400,
            8600,
            8900,
            9200,
            9400
        );

        $constants->singleAssetProtectionAllowances = array(
            0,
            100,
            200,
            300,
            500,
            600,
            700,
            800,
            900,
            1000,
            1100,
            1200,
            1400,
            1500,
            1600,
            1700,
            1700,
            1700,
            1800,
            1800,
            1900,
            1900,
            1900,
            2000,
            2000,
            2100,
            2100,
            2200,
            2200,
            2300,
            2300,
            2400,
            2500,
            2500,
            2600,
            2700,
            2700,
            2800,
            2900,
            2900,
            3000
        );

        $constants->businessFarmNetWorthAdjustmentRanges = array( 1, 135000, 410000, 680000 );
        $constants->businessFarmNetWorthAdjustmentBases = array( 0, 54000, 191500, 353500 );
        $constants->businessFarmNetWorthAdjustmentPercents = array( 40, 50, 60, 100 );

        return $constants;
	}

	public static function getIncomeCalculatorConstants()
	{
		$constants = new IncomeCalculatorConstants();
        $constants->aiAssessmentPercent = 0.5;

        return $constants;
	}

	public static function getEfcCalculatorConstants()
	{
        $constants = new EfcCalculatorConstants();

        $constants->altEnrollmentIncomeProtectionAllowance = 5280;
        $constants->simplifiedEfcMax = 49999;
        $constants->autoZeroEfcMax = 26000;

        return $constants;
	}
}

?>