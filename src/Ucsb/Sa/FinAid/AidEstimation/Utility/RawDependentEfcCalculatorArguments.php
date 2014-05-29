<?php
namespace Ucsb\Sa\FinAid\AidEstimation\Utility;

class RawDependentEfcCalculatorArguments
{

    // Work Income Values

    public $isFirstParentWorking;
    public $firstParentWorkIncome;
    public $isSecondParentWorking;
    public $secondParentWorkIncome;
    public $isStudentWorking;
    public $studentWorkIncome;


    // General Income Values

    public $parentAgi;
    public $areParentsTaxFilers;
    public $parentIncomeTax;
    public $parentUntaxedIncomeAndBenefits;
    public $parentAdditionalFinancialInfo;
    public $studentAgi;
    public $isStudentTaxFiler;
    public $studentIncomeTax;
    public $studentUntaxedIncomeAndBenefits;
    public $studentAdditionalFinancialInfo;


    // Asset Values

    public $parentCashSavingsChecking;
    public $parentInvestmentNetWorth;
    public $parentBusinessFarmNetWorth;
    public $studentCashSavingsChecking;
    public $studentInvestmentNetWorth;
    public $studentBusinessFarmNetWorth;


    // General Information

    public $maritalStatus;
    public $stateOfResidency;
    public $numberInHousehold;
    public $numberInCollege;
    public $oldestParentAge;
    public $isQualifiedForSimplified;
    public $monthsOfEnrollment;
}
?>