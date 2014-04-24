<?php
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\AaiContributionCalculator;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\EfcCalculationRole;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\Constants\AaiContributionCalculatorConstants;

class AaiContributionCalculatorTest extends PHPUnit_Framework_TestCase
{
    private $_aaiContributionCalculator;

    protected function setUp()
    {
        $constants = new AaiContributionCalculatorConstants();

        $constants->aaiContributionBases = array(0, 3366, 4341, 5472, 6798, 8358);
        $constants->aaiContributionPercents = array(22, 25, 29, 34, 40, 47);
        $constants->aaiContributionRanges = array(-3409, 15300, 19200, 23100, 27000, 30900);

        $this->_aaiContributionCalculator = new AaiContributionCalculator($constants);
    }

    public function testCalculateContributionFromAai_Student_SameValue()
    {
        $result = $this->_aaiContributionCalculator->calculateContributionFromAai(EfcCalculationRole::DependentStudent, 18300);
        $this->assertEquals(18300, $result);
    }

    public function testCalculateContributionFromAai_IndependentStudentWithoutDep_SameValue()
    {
        $result = $this->_aaiContributionCalculator->calculateContributionFromAai(EfcCalculationRole::IndependentStudentWithoutDependents, 18300);
        $this->assertEquals(18300, $result);
    }

    public function testCalculateContributionFromAai_Value_Calculated()
    {
        $result = $this->_aaiContributionCalculator->calculateContributionFromAai(EfcCalculationRole::Parent, 18300);
        $this->assertEquals(4116, $result);
    }

    public function testCalculateContributionFromAai_HighValue_Calculated()
    {
        $result = $this->_aaiContributionCalculator->calculateContributionFromAai(EfcCalculationRole::Parent, 202202);
        $this->assertEquals(88870, $result);
    }

    public function testCalculateContributionFromAai_LowValue_Calculated()
    {
        $result = $this->_aaiContributionCalculator->calculateContributionFromAai(EfcCalculationRole::Parent, -5000);
        $this->assertEquals(0, $result);
    }

    public function testCalculateContributionFromAai_DecimalValue_Rounded()
    {
        $result = $this->_aaiContributionCalculator->calculateContributionFromAai(EfcCalculationRole::Parent, 14500.55);
        $this->assertEquals(3190, $result);
    }
}
?>