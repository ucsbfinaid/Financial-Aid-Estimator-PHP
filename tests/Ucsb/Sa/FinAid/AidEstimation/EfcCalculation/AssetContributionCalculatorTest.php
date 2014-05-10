<?php
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\AssetContributionCalculator;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\EfcCalculationRole;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\MaritalStatus;

require_once 'TestConstantsFactory.php';

class AssetContributionCalculatorTest extends \PHPUnit_Framework_TestCase
{
	private $_calculator;

	public function setUp()
    {
        $this->_calculator = new AssetContributionCalculator(TestConstantsFactory::getAssetContributionCalculatorConstants());
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