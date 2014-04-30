<?php

use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\AssetContributionCalculator;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\EfcCalculationRole;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\MaritalStatus;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\Constants\AssetContributionCalculatorConstants;

class AssetContributionCalculatorTest extends PHPUnit_Framework_TestCase
{
	private $_calculator;

	public function setUp()
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

        $this->_calculator = new AssetContributionCalculator($constants);
    }

    public function testCalculateCashSavingsCheckingsContribution_Value_Calculated()
    {
        $result = $this->_calculator->calculateCashSavingsCheckingsContribution(1000);
        $this->assertEquals(1000, $result);
    }

    public function testCalculateCashSavingsCheckingsContribution_NegativeValue_EqualsZero()
    {
        $result = $this->_calculator->calculateCashSavingsCheckingsContribution(-1000);
        $this->assertEquals(0, $result);
    }

    public function testCalculateCashSavingsCheckingsContribution_DecimalValue_Rounded()
    {
        $result = $this->_calculator->calculateCashSavingsCheckingsContribution(1000.55);
        $this->assertEquals(1001, $result);
    }

    public function testCalculateInvestmentNetWorthContribution_Value_Calculated()
    {
        $result = $this->_calculator->calculateInvestmentNetWorthContribution(1000);
        $this->assertEquals(1000, $result);
    }

    public function testCalculateInvestmentNetWorthContribution_NegativeValue_EqualsZero()
    {
        $result = $this->_calculator->calculateInvestmentNetWorthContribution(-1000);
        $this->assertEquals(0, $result);
    }

    public function testCalculateInvestmentNetWorthContribution_DecimalValue_Rounded()
    {
        $result = $this->_calculator->calculateInvestmentNetWorthContribution(1000.55);
        $this->assertEquals(1001, $result);
    }

    public function testCalculateAdjustedBusinessFarmNetWorthContribution_Value_Calculated()
    {
        $result = $this->_calculator
            ->calculateAdjustedBusinessFarmNetWorthContribution(EfcCalculationRole::Parent, 202202);
        $this->assertEquals(89101, $result);
    }

    public function testCalculateAdjustedBusinessFarmNetWorthContribution_HighValue_Calculated()
    {
        $result = $this->_calculator
            ->calculateAdjustedBusinessFarmNetWorthContribution(EfcCalculationRole::Parent, 202202202);
        $this->assertEquals(201909702, $result);
    }

    public function testCalculateAdjustedBusinessFarmNetWorthContribution_LowValue_Calculated()
    {
        $result = $this->_calculator
            ->calculateAdjustedBusinessFarmNetWorthContribution(EfcCalculationRole::Parent, 1000);
        $this->assertEquals(400, $result);
    }

    public function testCalculateAdjustedBusinessFarmNetWorthContribution_NegativeValue_EqualsZero()
    {
        $result = $this->_calculator
            ->calculateAdjustedBusinessFarmNetWorthContribution(EfcCalculationRole::Parent, -1000);
        $this->assertEquals(0, $result);
    }

    public function testCalculateAdjustedBusinessFarmNetWorthContribution_DecimalValue_Rounded()
    {
        $result = $this->_calculator
            ->calculateAdjustedBusinessFarmNetWorthContribution(EfcCalculationRole::Parent, 80000.66);
        $this->assertEquals(32000, $result);
    }

    public function testCalculateAdjustedBusinessFarmNetWorthContribution_DependentStudent_Calculated()
    {
        $result = $this->_calculator
            ->calculateAdjustedBusinessFarmNetWorthContribution(EfcCalculationRole::DependentStudent, 8000);
        $this->assertEquals(8000, $result);
    }

    public function testCalculateAdjustedBusinessFarmNetWorthContribution_DependentStudentNegativeValue_EqualsZero()
    {
        $result = $this->_calculator
            ->calculateAdjustedBusinessFarmNetWorthContribution(EfcCalculationRole::DependentStudent, -8000);
        $this->assertEquals(0, $result);
    }

    public function testCalculateAdjustedBusinessFarmNetWorthContribution_DependentStudentDecimalValue_EqualsZero()
    {
        $result = $this->_calculator
            ->calculateAdjustedBusinessFarmNetWorthContribution(EfcCalculationRole::DependentStudent, 8000.66);
        $this->assertEquals(8001, $result);
    }

    public function testCalculateNetWorth_NormalValues_Calculated()
    {
        $result = $this->_calculator
            ->calculateNetWorth(EfcCalculationRole::Parent, 6000, 26000, 9000);
        $this->assertEquals(35600, $result);
    }

    public function testCalculateAssetProtectionAllowance_Values_Calculated()
    {
        $result = $this->_calculator->calculateAssetProtectionAllowance(MaritalStatus::MarriedRemarried, 30);
        $this->assertEquals(10700, $result);
    }

    public function testCalculateAssetProtectionAllowance_LowAge_EqualZero()
    {
        $result = $this->_calculator->calculateAssetProtectionAllowance(MaritalStatus::MarriedRemarried, 20);
        $this->assertEquals(0, $result);
    }

    public function testCalculateAssetProtectionAllowance_HighAge_Calculated()
    {
        $result = $this->_calculator->calculateAssetProtectionAllowance(MaritalStatus::MarriedRemarried, 70);
        $this->assertEquals(61800, $result);
    }

    public function testCalculateAssetProtectionAllowance_SingleParent_Calculated()
    {
        $result = $this->_calculator->calculateAssetProtectionAllowance(MaritalStatus::SingleSeparatedDivorced, 45);
        $this->assertEquals(10600, $result);
    }

    public function testCalculateDiscretionaryNetWorth_Values_Calculated()
    {
        $result = $this->_calculator
            ->calculateDiscretionaryNetWorth(EfcCalculationRole::Parent, MaritalStatus::MarriedRemarried, 45, 6000, 26000, 9000);
        $this->assertEquals(-600, $result);
    }

    public function testCalculateContributionFromAssets_Values_Calculated()
    {
        $result = $this->_calculator
            ->calculateContributionFromAssets(EfcCalculationRole::Parent, MaritalStatus::MarriedRemarried, 25, 6000, 26000, 9000);
        $this->assertEquals(4272, $result);
    }

    public function testCalculateContributionFromAssets_NegativeValue_EqualsZero()
    {
        $result = $this->_calculator
            ->calculateContributionFromAssets(EfcCalculationRole::Parent, MaritalStatus::MarriedRemarried, 45, 6000, 26000, 9000);
        $this->assertEquals(0, $result);
    }

    public function testCalculateContributionFromAssets_DependentStudent_Calculated()
    {
        $result = $this->_calculator
            ->calculateContributionFromAssets(EfcCalculationRole::DependentStudent, MaritalStatus::MarriedRemarried, 45, 6000, 26000, 9000);
        $this->assertEquals(8200, $result);
    }

    public function testCalculateContributionFromAssets_IndependentStudentWithoutDep_Calculated()
    {
        $result = $this->_calculator
            ->calculateContributionFromAssets(EfcCalculationRole::IndependentStudentWithoutDependents, MaritalStatus::MarriedRemarried, 30, 6000, 26000, 9000);
        $this->assertEquals(4980, $result);
    }

    public function testCalculateContributionFromAssets_IndependentStudentWithDep_Calculated()
    {
        $result = $this->_calculator
            ->calculateContributionFromAssets(EfcCalculationRole::IndependentStudentWithDependents, MaritalStatus::MarriedRemarried, 30, 6000, 26000, 9000);
        $this->assertEquals(1743, $result);
    }
}
?>