<?php
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\AaiContributionCalculator;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\EfcCalculationRole;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\Constants\AaiContributionCalculatorConstants;

require_once 'TestConstantsFactory.php';

class AaiContributionCalculatorTest extends \PHPUnit_Framework_TestCase
{
    private $_aaiContributionCalculator;

    protected function setUp()
    {
        $this->_aaiContributionCalculator = new AaiContributionCalculator(TestConstantsFactory::getAaiContributionCalculatorConstants());
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
        $this->assertEquals(4065, $result);
    }

    public function testCalculateContributionFromAai_HighValue_Calculated()
    {
        $result = $this->_aaiContributionCalculator->calculateContributionFromAai(EfcCalculationRole::Parent, 202202);
        $this->assertEquals(88163, $result);
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