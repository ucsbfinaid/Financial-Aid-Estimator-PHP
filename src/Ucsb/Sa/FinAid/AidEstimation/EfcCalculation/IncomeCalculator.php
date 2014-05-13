<?php
namespace Ucsb\Sa\FinAid\AidEstimation\EfcCalculation;

use Ucsb\Sa\FinAid\AidEstimation\Utility\EfcMathHelper;

/**
 * Income calculator
 * @package Ucsb\Sa\FinAid\AidEstimation\EfcCalculation
 */
class IncomeCalculator
{
	private $_constants;

	/**
	 * Constructs a new Income Calculator
	 * @param IncomeCalculatorConstants $constants Constants used in income calculations
	 */
	public function __construct($constants)
	{
		$this->_constants = $constants;
	}

	/**
	 * Calculates Total Income
	 * @param float $agi Adjusted Gross Income (AGI)
	 * @param float $workIncome Total income earned from work
	 * @param boolean $areTaxFilers Whether or not the person(s) is required to file taxes
	 * @param float $untaxedIncomeAndBenefits Total untaxed income and benefits
	 * @param float $additionalFinancialInfo Total additional financial infomation
	 * @return float
	 */
    public function calculateTotalIncome($agi, $workIncome, $areTaxFilers, $untaxedIncomeAndBenefits, $additionalFinancialInfo)
    {
        // If tax filers, Taxable Income is equal to Adjusted Gross Income; otherwise, it's equal to
        // Income Earned From Work
        $totalIncome = $areTaxFilers
            ? $this->calculateAdjustedGrossIncome($agi)
            : $this->calculateIncomeEarnedFromWork($workIncome);

        $totalIncome += $this->calculateTotalUntaxedIncomeAndBenefits($untaxedIncomeAndBenefits);
        $totalIncome -= $this->calculateAdditionalFinancialInformation($additionalFinancialInfo);

        return $totalIncome;
    }

    /**
     * Calculates contributions from Adjusted Gross Income
	 * @param float $agi Adjusted Gross Income (AGI)
	 * @return float
	 */
    public function calculateAdjustedGrossIncome($agi)
    {
        return EfcMathHelper::roundPositive($agi);
    }

    /**
     * Calculates contributions from Income Earned From Work
     * @param float $workIncome Total income earned from work
     * @return float
     */
    public function calculateIncomeEarnedFromWork($workIncome)
    {
        return EfcMathHelper::roundPositive($workIncome);
    }

    /**
     * Calculates contributions from Untaxed Income and Benefits
	 * @param float $untaxedIncomeAndBenefits Total untaxed income and benefits
	 * @return float
     */
    public function calculateTotalUntaxedIncomeAndBenefits($untaxedIncomeAndBenefits)
    {
    	return EfcMathHelper::roundPositive($untaxedIncomeAndBenefits);
    }

    /**
     * Calculates Contributions from Additional Financial Information
	 * @param float $additionalFinancialInfo Total additional financial infomation
     * @return float
     */
    public function calculateAdditionalFinancialInformation($additionalFinancialInfo)
    {
    	return EfcMathHelper::roundPositive($additionalFinancialInfo);
    }

    /**
     * Calculates Available Income
	 * @param EfcCalculationRole $role Subject's role within the calculation
	 * @param float $totalIncome Total income
	 * @param float $totalAllowances Total allowances
	 * @return float
     */
    public function calculateAvailableIncome($role, $totalIncome, $totalAllowances)
    {
        $availableIncome = EfcMathHelper::round($totalIncome - $totalAllowances);

        // The available income for Dependent Students and Independent Students Without Depends is
        // multiplied by an assessment percent
        if ($role == EfcCalculationRole::DependentStudent || $role == EfcCalculationRole::IndependentStudentWithoutDependents)
        {
            return $availableIncome < 0
                ? 0 : EfcMathHelper::round($availableIncome * $this->_constants->aiAssessmentPercent);
        }

        return $availableIncome;
    }
}
?>