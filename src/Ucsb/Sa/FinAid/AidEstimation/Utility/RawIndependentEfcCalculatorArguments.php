<?php
namespace Ucsb\Sa\FinAid\AidEstimation\Utility;

class RawIndependentEfcCalculatorArguments
{
    // Work Income Values

    public $isStudentWorking;
    public $studentWorkIncome;
    public $isSpouseWorking;
    public $spouseWorkIncome;

    // General Income Values

    public $studentAgi;
    public $isStudentTaxFiler;
    public $studentIncomeTax;
    public $studentUntaxedIncomeAndBenefits;
    public $studentAdditionalFinancialInfo;

    // Asset Values

    public $studentCashSavingsChecking;
    public $studentInvestmentNetWorth;
    public $studentBusinessFarmNetWorth;
    public $hasDependents;

    // General Info

    public $maritalStatus;
    public $stateOfResidency;
    public $numberInHousehold;
    public $numberInCollege;
    public $studentAge;
    public $isQualifiedForSimplified;
    public $monthsOfEnrollment;
}
?>