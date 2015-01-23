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

        $constants->aaiContributionBases = array(0, 3366, 4341, 5472, 6798, 8358);
        $constants->aaiContributionPercents = array(22, 25, 29, 34, 40, 47);
        $constants->aaiContributionRanges = array(-3409, 15300, 19200, 23100, 27000, 30900);

        return $constants;
	}

	public static function getAllowanceCalculatorConstants()
	{
		$constants = new AllowanceCalculatorConstants();

		$constants->stateTaxAllowanceIncomeThreshold = 15000;

        $constants->parentStateTaxAllowancePercents = array(
            2, 3, 2, 2, 4, 4, 8, 2, 5, 8, 5, 7, 2, 3, 6, 2, 4, 5, 5, 4, 5, 5, 5, 3, 6, 2, 8,
            7, 2, 5, 6, 3, 5, 5, 5, 3, 5, 9, 3, 9, 6, 3, 2, 6, 4, 7, 2, 5, 2, 7, 5, 2, 2, 3,
            5, 6, 2, 6, 4, 3, 7, 2
        );

        $constants->studentStateTaxAllowancePercents = array(
            2, 2, 0, 2, 2, 3, 5, 2, 3, 5, 3, 5, 2, 1, 3, 2, 3, 3, 2, 3, 3, 3, 4, 2, 4, 2, 6,
            4, 2, 3, 4, 3, 3, 3, 3, 1, 1, 4, 2, 6, 4, 1, 2, 3, 3, 5, 2, 3, 2, 4, 3, 1, 1, 1,
            3, 3, 2, 4, 1, 2, 4, 1
        );

        $constants->socialSecurityTaxIncomeThreshold = 110100;
        $constants->socialSecurityLowPercent = 0.0765;
        $constants->socialSecurityHighPercent = 0.0145;
        $constants->socialSecurityHighBase = 8422.65;

        $constants->employmentExpensePercent = 0.35;
        $constants->employmentExpenseMaximum = 3900;

        $constants->dependentParentIncomeProtectionAllowances = array(
            array( 0, 0, 0, 0, 0, 0 ),
            array( 0, 0, 0, 0, 0, 0 ),
            array( 0, 17100, 14170, 0, 0, 0 ),
            array( 0, 21290, 18380, 15450, 0, 0 ),
            array( 0, 26290, 23370, 20460, 17530, 0 ),
            array( 0, 31020, 28100, 25190, 22260, 19350 ),
            array( 0, 36290, 33360, 30450, 27530, 24620 )
        );

        $constants->independentWithDependentsIncomeProtectionAllowances = array(
            array( 0, 0, 0, 0, 0, 0 ),
            array( 0, 0, 0, 0, 0, 0 ),
            array( 0, 24150, 20020, 0, 0, 0 ),
            array( 0, 30070, 25960, 21830, 0, 0 ),
            array( 0, 37130, 33010, 28900, 24760, 0 ),
            array( 0, 43810, 39670, 35570, 31450, 27340 ),
            array( 0, 51230, 47110, 43020, 38870, 34770 )
        );

        $constants->dependentAdditionalStudentAllowance = 2910;
        $constants->dependentAdditionalFamilyAllowance = 4100;

        $constants->independentAdditionalStudentAllowance = 4110;
        $constants->independentAdditionalFamilyAllowance = 5780;

        $constants->dependentStudentIncomeProtectionAllowance = 6130;
        $constants->singleIndependentWithoutDependentsIncomeProtectionAllowance = 9540;
        $constants->marriedIndependentWithoutDependentsIncomeProtectionAllowance = 15290;

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
            0, 2100, 4300, 6400, 8600, 10700, 12800, 15000, 17100, 19300,
            21400, 23500, 25700, 27800, 30000, 32100, 32900, 33700, 34500,
            35400, 36200, 37100, 38000, 39000, 39900, 40900, 42100, 43100,
            44200, 45500, 46800, 47900, 49300, 50800, 52200, 53500, 55000,
            56900, 58500, 60100, 61800,
        );

        $constants->singleAssetProtectionAllowances = array(
            0, 600, 1300, 1900, 2500, 3200, 3800, 4400, 5100, 5700, 6300,
            7000, 7600, 8200, 8900, 9500, 9700, 9900, 10100, 10300, 10600,
            10800, 11100, 11300, 11600, 11900, 12200, 12500, 12800, 13100,
            13400, 13700, 14100, 14400, 14800, 15100, 15600, 16000, 16400,
            16900, 17400
        );

        $constants->businessFarmNetWorthAdjustmentRanges = array( 1, 120000, 365000, 610000 );
        $constants->businessFarmNetWorthAdjustmentBases = array( 0, 48000, 170500, 317500 );
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

        $constants->altEnrollmentIncomeProtectionAllowance = 4730;
        $constants->simplifiedEfcMax = 49999;
        $constants->autoZeroEfcMax = 24000;

        return $constants;
	}
}

?>