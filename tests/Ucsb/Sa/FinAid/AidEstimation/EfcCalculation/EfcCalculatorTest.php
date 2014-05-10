<?php
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\AaiContributionCalculator;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\AllowanceCalculator;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\Arguments\DependentEfcCalculatorArguments;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\Arguments\IndependentEfcCalculatorArguments;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\AssetContributionCalculator;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\EfcCalculator;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\HouseholdMember;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\IncomeCalculator;

require_once 'TestConstantsFactory.php';

class EfcCalculatorTest extends \PHPUnit_Framework_TestCase
{
    private $_efcCalculator;

    protected function setUp()
    {
        $constants = TestConstantsFactory::GetEfcCalculatorConstants();

        $incomeCalculator = new IncomeCalculator(TestConstantsFactory::GetIncomeCalculatorConstants());
        $allowanceCalculator = new AllowanceCalculator(TestConstantsFactory::GetAllowanceCalculatorConstants());
        $assetContributionCalculator = new AssetContributionCalculator(TestConstantsFactory::GetAssetContributionCalculatorConstants());
        $aaiContributionCalculator = new AaiContributionCalculator(TestConstantsFactory::GetAaiContributionCalculatorConstants());

        $this->_efcCalculator = new EfcCalculator(
            $constants, $incomeCalculator, $allowanceCalculator,
            $assetContributionCalculator, $aaiContributionCalculator);
    }

    public function testGetDependentEfcProfile_ZeroNumberInCollege_ZeroEfc()
    {
        $args = new DependentEfcCalculatorArguments();
        $args->numberInCollege = 0;
        $args->student = new HouseholdMember();

        $result = $this->_efcCalculator->getDependentEfcProfile($args);
        $this->assertEquals(0, $result->expectedFamilyContribution);
    }
}
?>