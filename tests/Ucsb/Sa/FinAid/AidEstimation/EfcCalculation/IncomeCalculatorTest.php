<?php
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\IncomeCalculator;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\Constants\IncomeCalculatorConstants;

class IncomeCalculatorTest extends PHPUnit_Framework_TestCase
{
    private $_incomeCalculator;

    public function setUp()
    {
        $constants = new IncomeCalculatorConstants();
        $constants->aiAssessmentPercent = 0.5;

        $this->_incomeCalculator = new IncomeCalculator($constants);
    }

    public function testCalculateAdjustedGrossIncome_Value_Calculated()
    {
        $result = $this->_incomeCalculator->calculateAdjustedGrossIncome(2000);
        $this->assertEquals(2000, $result);
    }


    public function testCalculateAdjustedGrossIncome_NegativeValue_EqualsZero()
    {
        $result = $this->_incomeCalculator->calculateAdjustedGrossIncome(-2000);
        $this->assertEquals(0, $result);
    }


    public function testCalculateAdjustedGrossIncome_DecimalValue_Rounded()
    {
        $result = $this->_incomeCalculator->calculateAdjustedGrossIncome(2000.55);
        $this->assertEquals(2001, $result);
    }


    public function testCalculateIncomeEarnedFromWork_Value_Calculated()
    {
        $result = $this->_incomeCalculator->calculateIncomeEarnedFromWork(2000);
        $this->assertEquals(2000, $result);
    }


    public function testCalculateIncomeEarnedFromWork_NegativeValue_EqualsZero()
    {
        $result = $this->_incomeCalculator->calculateIncomeEarnedFromWork(-2000);
        $this->assertEquals(0, $result);
    }


    public function testCalculateIncomeEarnedFromWork_DecimalValue_Rounded()
    {
        $result = $this->_incomeCalculator->calculateIncomeEarnedFromWork(2000.55);
        $this->assertEquals(2001, $result);
    }


    public function testCalculateTotalUntaxedIncomeAndBenefits_Value_Calculated()
    {
        $result = $this->_incomeCalculator->calculateTotalUntaxedIncomeAndBenefits(2000);
        $this->assertEquals(2000, $result);
    }


    public function testCalculateTotalUntaxedIncomeAndBenefits_NegativeValue_EqualsZero()
    {
        $result = $this->_incomeCalculator->calculateTotalUntaxedIncomeAndBenefits(-2000);
        $this->assertEquals(0, $result);
    }


    public function testCalculateTotalUntaxedIncomeAndBenefits_DecimalValue_Rounded()
    {
        $result = $this->_incomeCalculator->calculateTotalUntaxedIncomeAndBenefits(2000.55);
        $this->assertEquals(2001, $result);
    }


    public function testCalculateAdditionalFinancialInformation_Value_Calculated()
    {
        $result = $this->_incomeCalculator->calculateAdditionalFinancialInformation(2000);
        $this->assertEquals(2000, $result);
    }


    public function testCalculateAdditionalFinancialInformation_NegativeValue_EqualsZero()
    {
        $result = $this->_incomeCalculator->calculateAdditionalFinancialInformation(-2000);
        $this->assertEquals(0, $result);
    }


    public function testCalculateAdditionalFinancialInformation_DecimalValue_Rounded()
    {
        $result = $this->_incomeCalculator->calculateAdditionalFinancialInformation(2000.55);
        $this->assertEquals(2001, $result);
    }


    public function testCalculateTotalIncome_Values_Calculated()
    {
        $result = $this->_incomeCalculator->calculateTotalIncome(1000, 2000, true, 3000, 2000);
        $this->assertEquals(2000, $result);
    }
}
?>