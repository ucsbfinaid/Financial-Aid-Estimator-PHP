<?php
namespace Ucsb\Sa\FinAid\AidEstimation\Utility;

use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\Arguments\DependentEfcCalculatorArguments;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\Arguments\IndependentEfcCalculatorArguments;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\HouseholdMember;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\IncomeEarnedBy;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\MaritalStatus;
use Ucsb\Sa\FinAid\AidEstimation\Utility\ArgumentValidator;

class AidEstimationValidator
{
    private $_validator;

    // Is Working?

    const LabelIsFirstParentWorking = '"Did the First Parent Work?"';
    const LabelIsSecondParentWorking = '"Did the Second Parent Work?"';
    const LabelIsStudentWorking = '"Did the Student Work?"';
    const LabelIsSpouseWorking = '"Did the Spouse Work?"';
    const ParamIsFirstParentWorking = "isFirstParentWorking";
    const ParamIsSecondParentWorking = "isSecondParentWorking";
    const ParamIsStudentWorking = "isStudentWorking";
    const ParamIsSpouseWorking = "isSpouseWorking";

    // Work Income

    const LabelFirstParentWorkIncome = '"First Parent\'s Income Earned From Work"';
    const LabelSecondParentWorkIncome = '"Second Parent\'s Income Earned From Work"';
    const LabelStudentWorkIncome = '"Student\'s Income Earned From Work"';
    const LabelSpouseWorkIncome = '"Spouse\'s Income Earned From Work"';
    const ParamFirstParentWorkIncome = "firstParentWorkIncome";
    const ParamSecondParentWorkIncome = "secondParentWorkIncome";
    const ParamStudentWorkIncome = "studentWorkIncome";
    const ParamSpouseWorkIncome = "spouseWorkIncome";

    // AGI

    const LabelParentAgi = '"Parent(s)\' Adjusted Gross Income (AGI)"';
    const LabelStudentAgi = '"Student\'s Adjusted Gross Income (AGI)"';
    const LabelIndStudentAgi = '"Student and Spouse\'s Adjusted Gross Income (AGI)"';
    const ParamParentAgi = "parentAgi";
    const ParamStudentAgi = "studentAgi";
    const ParamIndStudentAgi = "studentAgi";

    // Are Tax Filers?

    const LabelAreParentsTaxFilers = '"Did Parent(s) File Taxes?"';
    const LabelIsStudentTaxFiler = '"Did the Student File Taxes?"';
    const LabelIsIndStudentTaxFiler = '"Did the Student and Spouse File Taxes?"';
    const ParamAreParentsTaxFilers = "areParentsTaxFilers";
    const ParamIsStudentTaxFiler = "isStudentTaxFiler";
    const ParamIsIndStudentTaxFiler = "isStudentTaxFiler";

    // Income Tax Paid

    const LabelParentIncomeTax = '"Parent(s)\' Income Taxes Paid"';
    const LabelStudentIncomeTax = '"Student\'s Income Taxes Paid"';
    const LabelIndStudentIncomeTax = '"Student and Spouse\'s Total Income Taxes Paid"';
    const ParamParentIncomeTax = "parentIncomeTax";
    const ParamStudentIncomeTax = "studentIncomeTax";
    const ParamIndStudentIncomeTax = "studentIncomeTax";

    // Untaxed Income And Benefits

    const LabelParentUntaxedIncomeAndBenefits = '"Parent(s)\' Untaxed Income and Benefits"';
    const LabelStudentUntaxedIncomeAndBenefits = '"Student\'s Untaxed Income and Benefits"';
    const LabelIndStudentUntaxedIncomeAndBenefits = '"Student and Spouse\'s Untaxed Income and Benefits"';
    const ParamParentUntaxedIncomeAndBenefits = "parentUntaxedIncomeAndBenefits";
    const ParamStudentUntaxedIncomeAndBenefits = "studentUntaxedIncomeAndBenefits";
    const ParamIndStudentUntaxedIncomeAndBenefits = "studentUntaxedIncomeAndBenefits";

    // Additional Financial Information

    const LabelParentAdditionalFinancialInfo = '"Parent(s)\' Additional Financial Information"';
    const LabelStudentAdditionalFinancialInfo = '"Student\'s Additional Financial Information"';
    const LabelIndStudentAdditionalFinancialInfo = '"Student and Spouse\'s Additional Financial Information"';
    const ParamParentAdditionalFinancialInfo = "parentAdditionalFinancialInfo";
    const ParamStudentAdditionalFinancialInfo = "studentAdditionalFinancialInfo";
    const ParamIndStudentAdditionalFinancialInfo = "studentAdditionalFinancialInfo";

    // Cash, Savings, Checking

    const LabelParentCashSavingsChecking = '"Parent(s)\' Cash, Savings, and Checking"';
    const LabelStudentCashSavingsChecking = '"Student\'s Cash, Savings, and Checking"';
    const LabelIndStudentCashSavingsChecking = '"Student and Spouse\'s Cash, Savings, and Checking"';
    const ParamParentCashSavingsChecking = "parentCashSavingsChecking";
    const ParamStudentCashSavingsChecking = "studentCashSavingsChecking";
    const ParamIndStudentCashSavingsChecking = "studentCashSavingsChecking";

    // Investment Net Worth

    const LabelParentInvestmentNetWorth = '"Net Worth of Parent(s)\' Investments"';
    const LabelStudentInvestmentNetWorth = '"Net Worth of Student\'s Investments"';
    const LabelIndStudentInvestmentNetWorth = '"Net Worth of Student and Spouse\'s Investments"';
    const ParamParentInvestmentNetWorth = "parentInvestmentNetWorth";
    const ParamStudentInvestmentNetWorth = "studentInvestmentNetWorth";
    const ParamIndStudentInvestmentNetWorth = "studentInvestmentNetWorth";

    // Business Farm Net Worth

    const LabelParentBusinessFarmNetWorth = '"Net Worth of Parent(s)\' Business and/or Investment Farm"';
    const LabelStudentBusinessFarmNetWorth = '"Net Worth of Student\'s Business and/or Investment Farm"';
    const LabelIndStudentBusinessFarmNetWorth = '"Net Worth of Student and Spouse\'s Business and/or Investment Farm"';
    const ParamParentBusinessFarmNetWorth = "parentBusinessFarmNetWorth";
    const ParamStudentBusinessFarmNetWorth = "studentBusinessFarmNetWorth";
    const ParamIndStudentBusinessFarmNetWorth = "studentBusinessFarmNetWorth";

    // Has Dependents

    const LabelIndStudentHasDep = '"Student has Dependents"';
    const ParamIndStudentHasDep = "hasDependents";

    // Marital Status

    const ParamMaritalStatus = "maritalStatus";
    const LabelParentMaritalStatus = '"Parent(s)\' Marital Status"';
    const LabelIndStudentMaritalStatus = '"Student\'s Marital Status"';

    // State of Residency

    const LabelStateOfResidency = '"State of Residency"';
    const ParamStateOfResidency = "stateOfResidency";

    // Number in Household

    const LabelNumInHousehold = '"Number in Household"';
    const ParamNumInHousehold = "numberInHousehold";

    // Number in College

    const LabelNumInCollege = '"Number in College"';
    const ParamNumInCollege = "numberInCollege";

    // Age

    const LabelOldestParentAge = '"Age of Oldest Parent"';
    const LabelIndStudentAge = '"Student\'s Age"';
    const ParamOldestParentAge = "oldestParentAge";
    const ParamIndStudentAge = "studentAge";

    // Months of Enrollment

    const LabelMonthsOfEnrollment = '"Months of Enrollment"';
    const ParamMonthsOfEnrollment = "monthsOfEnrollment";

    // Is Qualified for Simplified?

    const LabelIsQualifiedForSimplified = '"Is Qualified for Simplified?"';
    const ParamIsQualifiedForSimplified = "isQualifiedForSimplified";

    // SIMPLE CONSTANTS

    // Income

    const LabelParentIncome = '"Parent(s)\' Income"';
    const LabelStudentIncome = '"Student\'s Income"';
    const LabelIndStudentIncome = '"Student and Spouse\'s Total Income"';
    const ParamParentIncome = "parentIncome";
    const ParamStudentIncome = "studentIncome";
    const ParamIndStudentIncome = "studentIncome";

    // Income Earned By

    const LabelParentIncomeEarnedBy = '"Parent(s)\' Income Earned By"';
    const LabelIndStudentIncomeEarnedBy = '"Student\'s Income Earned By"';
    const ParamParentIncomeEarnedBy = "parentIncomeEarnedBy";
    const ParamIndStudentIncomeEarnedBy = "studentIncomeEarnedBy";

    // Other Income

    const LabelParentOtherIncome = '"Parent(s)\' Other Income"';
    const LabelStudentOtherIncome = '"Student\'s Other Income"';
    const LabelIndStudentOtherIncome = '"Student and Spouse\'s Other Income"';
    const ParamParentOtherIncome = "parentOtherIncome";
    const ParamStudentOtherIncome = "studentOtherIncome";
    const ParamIndStudentOtherIncome = "studentOtherIncome";

    // Assets

    const LabelParentAssets = '"Parent(s)\' Assets"';
    const LabelStudentAssets = '"Student\'s Assets"';
    const LabelIndStudentAssets = '"Student and Spouse\'s Assets"';
    const ParamParentAssets = "parentAssets";
    const ParamStudentAssets = "studentAssets";
    const ParamIndStudentAssets = "studentAssets";

    public function __construct()
    {
        $this->_validator = new ArgumentValidator();
    }

    public function hasErrors()
    {
        return (count($this->_validator->errors) > 0);
    }

    public function getErrors()
    {
        return $this->_validator->errors;
    }

    /**
     * Parses "raw" string values into a DependentEfcCalculatorArguments object that
     * can be passed to the EfcCalculator. If validation errors occur while parsing the values,
     * they are added to the errors property of this validator
     * @param RawDependentEfcCalculatorArguments $args Set of "raw" string arguments to parse
     * @return DependentEfcCalculatorArguments
     */
    public function validateDependentEfcCalculatorArguments($args)
    {
        if ($args == null)
        {
            throw new Exception("No raw arguments provided");
        }

        // Oldest Parent Age
        $oldestParentAge
        	= $this->_validator->validateNonZeroInteger(
        			$args->oldestParentAge,
        			self::LabelOldestParentAge,
        			self::ParamOldestParentAge);

        // Marital Status
        $maritalStatus
        	= $this->_validator->validateMaritalStatus(
        			$args->maritalStatus,
        			self::LabelParentMaritalStatus,
        			self::ParamMaritalStatus);

        // Is First Parent Working?
        $isFirstParentWorking
        	= $this->_validator->validateBoolean(
        			$args->isFirstParentWorking,
        			self::LabelIsFirstParentWorking,
        			self::ParamIsFirstParentWorking);

        // First Parent Work Income
        $firstParentWorkIncome
        	= $isFirstParentWorking
        		? $this->_validator->validatePositiveMoneyValue(
        				$args->firstParentWorkIncome,
        				self::LabelFirstParentWorkIncome,
        				self::ParamFirstParentWorkIncome)
        		: 0;

        $firstParent = new HouseholdMember();
        $firstParent->isWorking = $isFirstParentWorking;
        $firstParent->workIncome = $firstParentWorkIncome;

        $secondParent = null;
        if ($maritalStatus == MaritalStatus::MarriedRemarried)
        {
            // Is Second Parent Working?
            $isSecondParentWorking
                = $this->_validator->validateBoolean(
                        $args->isSecondParentWorking,
                        self::LabelIsSecondParentWorking,
                        self::ParamIsSecondParentWorking);

            // Mother Work Income
            $secondParentWorkIncome
                = $isSecondParentWorking
                      ? $this->_validator->validatePositiveMoneyValue(
                            $args->secondParentWorkIncome,
                            self::LabelSecondParentWorkIncome,
                            self::ParamSecondParentWorkIncome)
                      : 0;

            $secondParent = new HouseholdMember();
            $secondParent->isWorking = $isSecondParentWorking;
            $secondParent->workIncome = $secondParentWorkIncome;
        }

        // Is Student Working?
        $isStudentWorking
            = $this->_validator->validateBoolean(
                    $args->isStudentWorking,
                    self::LabelIsStudentWorking,
                    self::ParamIsStudentWorking);

        // Student Work Income
        $studentWorkIncome
            = $isStudentWorking
                  ? $this->_validator->validatePositiveMoneyValue(
                        $args->studentWorkIncome,
                        self::LabelStudentWorkIncome,
                        self::ParamStudentWorkIncome)
                  : 0;

        $student = new HouseholdMember();
        $student->isWorking = $isStudentWorking;
        $student->workIncome = $studentWorkIncome;

        // Parent AGI
        $parentAgi
            = $this->_validator->validateMoneyValue(
                    $args->parentAgi,
                    self::LabelParentAgi,
                    self::ParamParentAgi);

        // Are Parents Tax Filers?
        $areParentsTaxFilers
            = $this->_validator->validateBoolean(
                    $args->areParentsTaxFilers,
                    self::LabelAreParentsTaxFilers,
                    self::ParamAreParentsTaxFilers);

        // Parent Income Tax Paid
        $parentIncomeTaxPaid
            = $this->_validator->validateMoneyValue(
                    $args->parentIncomeTax,
                    self::LabelParentIncomeTax,
                    self::ParamParentIncomeTax);

        // Parent Untaxed Income and Benefits
        $parentUntaxedIncomeAndBenefits
            = $this->_validator->validatePositiveMoneyValue(
                    $args->parentUntaxedIncomeAndBenefits,
                    self::LabelParentUntaxedIncomeAndBenefits,
                    self::ParamParentUntaxedIncomeAndBenefits);

        // Parent Additional Financial Info
        $parentAdditionalFinancialInfo
            = $this->_validator->validatePositiveMoneyValue(
                    $args->parentAdditionalFinancialInfo,
                    self::LabelParentAdditionalFinancialInfo,
                    self::ParamParentAdditionalFinancialInfo);

        // Student AGI
        $studentAgi
            = $this->_validator->validateMoneyValue(
                    $args->studentAgi,
                    self::LabelStudentAgi,
                    self::ParamStudentAgi);

        // Is Student Tax Filer?
        $isStudentTaxFiler
            = $this->_validator->validateBoolean(
                    $args->isStudentTaxFiler,
                    self::LabelIsStudentTaxFiler,
                    self::ParamIsStudentTaxFiler);

        // Student Income Tax Paid
        $studentIncomeTaxPaid
            = $this->_validator->validateMoneyValue(
                    $args->studentIncomeTax,
                    self::LabelStudentIncomeTax,
                    self::ParamStudentIncomeTax);

        // Student Untaxed Income and Benefits
        $studentUntaxedIncomeAndBenefits
            = $this->_validator->validatePositiveMoneyValue(
                    $args->studentUntaxedIncomeAndBenefits,
                    self::LabelStudentUntaxedIncomeAndBenefits,
                    self::ParamStudentUntaxedIncomeAndBenefits);

        // Student Additional Financial Information
        $studentAdditionalFinancialInfo
            = $this->_validator->validatePositiveMoneyValue(
                    $args->studentAdditionalFinancialInfo,
                    self::LabelStudentAdditionalFinancialInfo,
                    self::ParamStudentAdditionalFinancialInfo);

        // Parent Cash, Savings, Checking
        $parentCashSavingsChecking
            = $this->_validator->validatePositiveMoneyValue(
                    $args->parentCashSavingsChecking,
                    self::LabelParentCashSavingsChecking,
                    self::ParamParentCashSavingsChecking);

        // Parent Investment Net Worth
        $parentInvestmentNetWorth
            = $this->_validator->validateMoneyValue(
                    $args->parentInvestmentNetWorth,
                    self::LabelParentInvestmentNetWorth,
                    self::ParamParentInvestmentNetWorth);

        // Parent Business Farm Net Worth
        $parentBusinessFarmNetWorth
            = $this->_validator->validateMoneyValue(
                    $args->parentBusinessFarmNetWorth,
                    self::LabelParentBusinessFarmNetWorth,
                    self::ParamParentBusinessFarmNetWorth);

        // Student Cash, Savings, Checkings
        $studentCashSavingsCheckings
            = $this->_validator->validatePositiveMoneyValue(
                    $args->studentCashSavingsChecking,
                    self::LabelStudentCashSavingsChecking,
                    self::ParamStudentCashSavingsChecking);

        // Student Investment Net Worth
        $studentInvestmentNetWorth
            = $this->_validator->validateMoneyValue(
                    $args->studentInvestmentNetWorth,
                    self::LabelStudentInvestmentNetWorth,
                    self::ParamStudentInvestmentNetWorth);

        // Student Business Farm Net Worth
        $studentBusinessFarmNetWorth
            = $this->_validator->validateMoneyValue(
                $args->studentBusinessFarmNetWorth,
                self::LabelStudentBusinessFarmNetWorth,
                self::ParamStudentBusinessFarmNetWorth);

        // State of Residency
        $stateOfResidency
            = $this->_validator->validateUnitedStatesStateOrTerritory(
                $args->stateOfResidency,
                self::LabelStateOfResidency,
                self::ParamStateOfResidency);

        // Number in Household
        $numberInHousehold
            = $this->_validator->validateNonZeroInteger(
                $args->numberInHousehold,
                self::LabelNumInHousehold,
                self::ParamNumInHousehold);

        // Number in College
        $numberInCollege
            = $this->_validator->validateNonZeroInteger(
                $args->numberInCollege,
                self::LabelNumInCollege,
                self::ParamNumInCollege);

        // CHECK: If Married, Number in Household must be greater than 3
        if ($numberInHousehold > 0
            && $maritalStatus == MaritalStatus::MarriedRemarried
            && $numberInHousehold < 3)
        {
            $this->_validator->errors[] = new ValidationError(self::ParamNumInHousehold,
                sprintf('%s was "Married/Remarried, but %s was less than three',
                self::LabelParentMaritalStatus, self::LabelNumInHousehold));
        }
        // CHECK: Number in household must be greater than two
        else if ($numberInHousehold > 0 && $numberInHousehold < 2)
        {
            $this->_validator->errors[] = new ValidationError(self::ParamNumInHousehold,
                sprintf('%s must equal at least two', self::LabelNumInHousehold));
        }

        // CHECK: Number in Household must be greater than or equal to Number in College
        if ($numberInCollege > $numberInHousehold)
        {
            $this->_validator->errors[] = new ValidationError(self::ParamNumInCollege,
                sprintf('%s must be less than or equal to %s',
                self::LabelNumInCollege, self::LabelNumInHousehold));
        }

        // Is Qualified For Simplified?
        $isQualifiedForSimplified
            = $this->_validator->validateBoolean(
                $args->isQualifiedForSimplified,
                self::LabelIsQualifiedForSimplified,
                self::ParamIsQualifiedForSimplified);

        // Months of Enrollment
        $monthsOfEnrollment
            = $this->_validator->validateNonZeroInteger(
                $args->monthsOfEnrollment,
                self::LabelMonthsOfEnrollment,
                self::ParamMonthsOfEnrollment);

        if (count($this->_validator->errors) > 0)
        {
            return null;
        }

        // Build calculation arguments
        $parsedArgs = new DependentEfcCalculatorArguments();
        $parsedArgs->firstParent = $firstParent;
        $parsedArgs->secondParent = $secondParent;
        $parsedArgs->student = $student;
        $parsedArgs->parentAdjustedGrossIncome = $parentAgi;
        $parsedArgs->areParentsTaxFilers = $areParentsTaxFilers;
        $parsedArgs->parentIncomeTaxPaid = $parentIncomeTaxPaid;
        $parsedArgs->parentUntaxedIncomeAndBenefits = $parentUntaxedIncomeAndBenefits;
        $parsedArgs->parentAdditionalFinancialInfo = $parentAdditionalFinancialInfo;
        $parsedArgs->studentAdjustedGrossIncome = $studentAgi;
        $parsedArgs->isStudentTaxFiler = $isStudentTaxFiler;
        $parsedArgs->studentIncomeTaxPaid = $studentIncomeTaxPaid;
        $parsedArgs->studentUntaxedIncomeAndBenefits = $studentUntaxedIncomeAndBenefits;
        $parsedArgs->studentAdditionalFinancialInfo = $studentAdditionalFinancialInfo;
        $parsedArgs->parentCashSavingsChecking = $parentCashSavingsChecking;
        $parsedArgs->parentInvestmentNetWorth = $parentInvestmentNetWorth;
        $parsedArgs->parentBusinessFarmNetWorth = $parentBusinessFarmNetWorth;
        $parsedArgs->studentCashSavingsChecking = $studentCashSavingsCheckings;
        $parsedArgs->studentInvestmentNetWorth = $studentInvestmentNetWorth;
        $parsedArgs->studentBusinessFarmNetWorth = $studentBusinessFarmNetWorth;
        $parsedArgs->maritalStatus = $maritalStatus;
        $parsedArgs->stateOfResidency = $stateOfResidency;
        $parsedArgs->numberInHousehold = $numberInHousehold;
        $parsedArgs->numberInCollege = $numberInCollege;
        $parsedArgs->oldestParentAge = $oldestParentAge;
        $parsedArgs->isQualifiedForSimplified = $isQualifiedForSimplified;
        $parsedArgs->monthsOfEnrollment = $monthsOfEnrollment;

        return $parsedArgs;
    }

    /**
     * Parses "raw" string values into a IndependentEfcCalculatorArguments object that
     * can be passed to the EfcCalculator. If validation errors occur while parsing the values,
     * they are added to the errors property of this validator
     * @param RawIndependentEfcCalculatorArguments $args Set of "raw" string arguments to parse
     * @return IndependentEfcCalculatorArguments
     */
    public function validateIndependentEfcCalculatorArguments($args)
    {
        if ($args == null)
        {
            throw new Exception("No raw arguments provided");
        }

        // Age
        $age
            = $this->_validator->validateNonZeroInteger(
                    $args->studentAge,
                    self::LabelIndStudentAge,
                    self::ParamIndStudentAge);

        // Marital Status
        $maritalStatus
            = $this->_validator->validateMaritalStatus(
                    $args->maritalStatus,
                    self::LabelIndStudentMaritalStatus,
                    self::ParamMaritalStatus);

        // Is Student Working?
        $isStudentWorking
            = $this->_validator->validateBoolean(
                    $args->isStudentWorking,
                    self::LabelIsStudentWorking,
                    self::ParamIsStudentWorking);

        // Student Work Income
        $studentWorkIncome
            = $isStudentWorking
                    ? $this->_validator->validatePositiveMoneyValue(
                        $args->studentWorkIncome,
                        self::LabelStudentWorkIncome,
                        self::ParamStudentWorkIncome)
                    : 0;

        $student = new HouseholdMember();
        $student->isWorking = $isStudentWorking;
        $student->workIncome = $studentWorkIncome;

        $spouse = null;
        
        if ($maritalStatus == MaritalStatus::MarriedRemarried)
        {
            // Is Spouse Working?
            $isSpouseWorking
                = $this->_validator->validateBoolean(
                        $args->isSpouseWorking,
                        self::LabelIsSpouseWorking,
                        self::ParamIsSpouseWorking);

            // Spouse Work Income
            $spouseWorkIncome
                = $isSpouseWorking
                        ? $this->_validator->validatePositiveMoneyValue(
                                $args->spouseWorkIncome,
                                self::LabelSpouseWorkIncome,
                                self::ParamSpouseWorkIncome)
                        : 0;

            $spouse = new HouseholdMember();
            $isWorking = $isSpouseWorking;
            $workIncome = $spouseWorkIncome;
        }

        // Student and Spouse's AGI
        $agi = $this->_validator->validateMoneyValue(
                        $args->studentAgi,
                        self::LabelIndStudentAgi,
                        self::ParamIndStudentAgi);

        // Are Tax Filers?
        $areTaxFilers
            = $this->_validator->validateBoolean(
                    $args->isStudentTaxFiler,
                    self::LabelIsIndStudentTaxFiler,
                    self::ParamIsIndStudentTaxFiler);

        // Income Tax Paid
        $incomeTaxPaid
            = $this->_validator->validateMoneyValue(
                    $args->studentIncomeTax,
                    self::LabelIndStudentIncomeTax,
                    self::ParamIndStudentIncomeTax);

        // Untaxed Income And Benefits
        $untaxedIncomeAndBenefits
            = $this->_validator->validatePositiveMoneyValue(
                    $args->studentUntaxedIncomeAndBenefits,
                    self::LabelIndStudentUntaxedIncomeAndBenefits,
                    self::ParamIndStudentUntaxedIncomeAndBenefits);

        // Additional Financial Information
        $additionalFinancialInfo
            = $this->_validator->validatePositiveMoneyValue(
                    $args->studentAdditionalFinancialInfo,
                    self::LabelIndStudentAdditionalFinancialInfo,
                    self::ParamIndStudentAdditionalFinancialInfo);

        // Cash, Savings, Checking
        $cashSavingsChecking
            = $this->_validator->validatePositiveMoneyValue(
                    $args->studentCashSavingsChecking,
                    self::LabelIndStudentCashSavingsChecking,
                    self::ParamIndStudentCashSavingsChecking);

        // Investment Net Worth
        $investmentNetWorth
            = $this->_validator->validateMoneyValue(
                    $args->studentInvestmentNetWorth,
                    self::LabelIndStudentInvestmentNetWorth,
                    self::ParamIndStudentInvestmentNetWorth);

        // Business Farm Net Worth
        $businessFarmNetWorth
            = $this->_validator->validateMoneyValue(
                    $args->studentBusinessFarmNetWorth,
                    self::LabelIndStudentBusinessFarmNetWorth,
                    self::ParamIndStudentBusinessFarmNetWorth);

        // Has Dependents?
        $hasDependents
            = $this->_validator->validateBoolean(
                    $args->hasDependents,
                    self::LabelIndStudentHasDep,
                    self::ParamIndStudentHasDep);

        // State of Residency
        $stateOfResidency
            = $this->_validator->validateUnitedStatesStateOrTerritory(
                    $args->stateOfResidency,
                    self::LabelStateOfResidency,
                    self::ParamStateOfResidency);

        // Number in Household
        $numberInHousehold
            = $this->_validator->validateNonZeroInteger(
                    $args->numberInHousehold,
                    self::LabelNumInHousehold,
                    self::ParamNumInHousehold);

        // Number in College
        $numberInCollege
            = $this->_validator->validateNonZeroInteger(
                    $args->numberInCollege,
                    self::LabelNumInCollege,
                    self::ParamNumInCollege);

        // CHECK: Number in Household must be greater than or equal to Number in College
        if ($numberInCollege > $numberInHousehold)
        {
            $this->_validator->errors[] = new ValidationError(self::ParamNumInCollege,
                sprintf('%s must be less than or equal to %s',
                self::LabelNumInCollege, self::LabelNumInHousehold));
        }

        // CHECK: If student has dependents, Number in Household can not be less than two
        if ($hasDependents && $numberInHousehold < 2)
        {
            $this->_validator->errors[] = new ValidationError(self::ParamIndStudentHasDep,
                sprintf('Student has dependents, but %s was less than two.',
                self::LabelNumInHousehold));
        }

        // Is Qualified for Simplified
        $isQualifiedForSimplified
            = $this->_validator->validateBoolean(
                    $args->isQualifiedForSimplified,
                    self::LabelIsQualifiedForSimplified,
                    self::ParamIsQualifiedForSimplified);

        // Months of Enrollment
        $monthsOfEnrollment
            = $this->_validator->validateNonZeroInteger(
                    $args->monthsOfEnrollment,
                    self::LabelMonthsOfEnrollment,
                    self::ParamMonthsOfEnrollment);

        if (count($this->_validator->errors) > 0)
        {
            return null;
        }

        // Build calculation arguments
        $parsedArgs = new IndependentEfcCalculatorArguments();
        $parsedArgs->student = $student;
        $parsedArgs->spouse = $spouse;
        $parsedArgs->adjustedGrossIncome = $agi;
        $parsedArgs->areTaxFilers = $areTaxFilers;
        $parsedArgs->incomeTaxPaid = $incomeTaxPaid;
        $parsedArgs->untaxedIncomeAndBenefits = $untaxedIncomeAndBenefits;
        $parsedArgs->additionalFinancialInfo = $additionalFinancialInfo;
        $parsedArgs->cashSavingsCheckings = $cashSavingsChecking;
        $parsedArgs->investmentNetWorth = $investmentNetWorth;
        $parsedArgs->businessFarmNetWorth = $businessFarmNetWorth;
        $parsedArgs->hasDependents = $hasDependents;
        $parsedArgs->maritalStatus = $maritalStatus;
        $parsedArgs->stateOfResidency = $stateOfResidency;
        $parsedArgs->numberInHousehold = $numberInHousehold;
        $parsedArgs->numberInCollege = $numberInCollege;
        $parsedArgs->age = $age;
        $parsedArgs->isQualifiedForSimplified = $isQualifiedForSimplified;
        $parsedArgs->monthsOfEnrollment = $monthsOfEnrollment;

        return $parsedArgs;
    }

    /**
     * Parses "raw" string values into a DependentEfcCalculatorArguments object that
     * can be passed to the EfcCalculator. If validation errors occur while parsing the values,
     * they are added to the errors property of this validator
     * @param RawSimpleDependentEfcCalculatorArguments $args Set of "raw" string arguments to parse
     * @return DependentEfcCalculatorArguments
     */
    public function validateSimpleDependentEfcCalculatorArguments($args)
    {
        if ($args == null)
        {
            throw new Exception("No raw arguments provided");
        }

        // Marital Status
        $maritalStatus = 
            $this->_validator->validateMaritalStatus(
                $args->maritalStatus,
                self::LabelParentMaritalStatus,
                self::ParamMaritalStatus);

        // Parent Income
        $parentIncome =
            $this->_validator->validatePositiveMoneyValue(
                    $args->parentIncome,
                    self::LabelParentIncome,
                    self::ParamParentIncome);

        // Parent Other Income
        $parentOtherIncome =
            $this->_validator->validatePositiveMoneyValue(
                    $args->parentOtherIncome,
                    self::LabelParentOtherIncome,
                    self::ParamParentOtherIncome);

        // Parent Income Earned By
        $incomeEarnedBy =
            $this->_validator->validateIncomeEarnedBy(
                $args->parentIncomeEarnedBy,
                self::LabelParentIncomeEarnedBy,
                self::ParamParentIncomeEarnedBy);

        // CHECK: If Single/Separated/Divorced, "Parent Income Earned By" can not be "Both"
        if ($maritalStatus == MaritalStatus::SingleSeparatedDivorced && incomeEarnedBy == IncomeEarnedBy::Both)
        {
            $this->_validator->errors[] = new ValidationError(self::ParamParentIncomeEarnedBy,
                sprintf('%s was "Single/Separated/Divorced", but %s was marked as earned by both parents',
                self::LabelParentMaritalStatus, self::LabelParentIncomeEarnedBy));
        }

        // CHECK: If "Parent Income Earned By" is "None', then "Parent Income" must be 0
        if ($incomeEarnedBy == IncomeEarnedBy::None && $parentIncome > 0)
        {
            $this->_validator->errors[] = new ValidationError(self::ParamParentIncome,
                sprintf('%s was marked as earned by neither parents, but %s was greater than 0',
                    self::LabelParentIncomeEarnedBy, self::LabelParentIncome));
        }

        // Parent Income Tax Paid
        $parentIncomeTaxPaid =
            $this->_validator->validatePositiveMoneyValue(
                $args->parentIncomeTax,
                self::LabelParentIncomeTax,
                self::ParamParentIncomeTax);

        // Parent Assets
        $parentAssets =
            $this->_validator->validatePositiveMoneyValue(
                $args->parentAssets,
                self::LabelParentAssets,
                self::ParamParentAssets);

        // Student Income
        $studentIncome =
            $this->_validator->validatePositiveMoneyValue(
                $args->studentIncome,
                self::LabelStudentIncome,
                self::ParamStudentIncome);

        // Student Other Income
        $studentOtherIncome =
            $this->_validator->validatePositiveMoneyValue(
                $args->studentOtherIncome,
                self::LabelStudentOtherIncome,
                self::ParamStudentOtherIncome);

        // Student Income Tax Paid
        $studentIncomeTaxPaid =
            $this->_validator->validatePositiveMoneyValue(
                $args->studentIncomeTax,
                self::LabelStudentIncomeTax,
                self::ParamStudentIncomeTax);

        // Student Assets
        $studentAssets =
            $this->_validator->validatePositiveMoneyValue(
                $args->studentAssets,
                self::LabelStudentAssets,
                self::ParamStudentAssets);

        // Number in Household
        $numberInHousehold =
            $this->_validator->validateNonZeroInteger(
                $args->numberInHousehold,
                self::LabelNumInHousehold,
                self::ParamNumInHousehold);

        // Number in College
        $numberInCollege =
            $this->_validator->validateNonZeroInteger(
                $args->numberInCollege,
                self::LabelNumInCollege,
                self::ParamNumInCollege);

        // CHECK: Number in Household must be greater than or equal to Number in College
        if ($numberInCollege > $numberInHousehold)
        {
            $this->_validator->errors[] = new ValidationError(self::ParamNumInCollege,
                sprintf('%s must be less than or equal to %s',
                self::LabelNumInCollege, self::LabelNumInHousehold));
        }

        // State of Residency
        $stateOfResidency =
            $this->_validator->validateUnitedStatesStateOrTerritory(
                $args->stateOfResidency,
                self::LabelStateOfResidency,
                self::ParamStateOfResidency);

        if (count($this->_validator->errors) > 0)
        {
            return null;
        }

        // Build a list of arguments for the full EFC calculation using assumed
        // values gleaned from the "simplified" values provided

        $isFirstParentWorking = false;
        $isSecondParentWorking = false;

        $firstParentWorkIncome = 0;
        $secondParentWorkIncome = 0;

        if ($incomeEarnedBy == IncomeEarnedBy::One)
        {
            $isFirstParentWorking = true;
            $firstParentWorkIncome = $parentIncome;
        }

        if ($incomeEarnedBy == IncomeEarnedBy::Both)
        {
            $isFirstParentWorking = $isSecondParentWorking = true;
            $firstParentWorkIncome = $secondParentWorkIncome = ($parentIncome / 2);
        }

        $firstParent = new HouseholdMember();
        $firstParent->isWorking = $isFirstParentWorking;
        $firstParent->workIncome = $firstParentWorkIncome;

        $secondParent = null;
        if ($maritalStatus == MaritalStatus::MarriedRemarried)
        {
            $secondParent = new HouseholdMember();
            $secondParent->isWorking = $isSecondParentWorking;
            $secondParent->workIncome = $secondParentWorkIncome;
        }

        // ASSUME: Student is working
        $student = new HouseholdMember();
        $student->isWorking = true;
        $student->workIncome = $studentIncome;

        // Build calculation arguments
        $parsedArgs = new DependentEfcCalculatorArguments();

        $parsedArgs->firstParent = $firstParent;
        $parsedArgs->secondParent = $secondParent;
        $parsedArgs->student = $student;

        // ASSUME: "Age of Oldest Parent" is 45
        $parsedArgs->oldestParentAge = 45;

        // ASSUME: "Parent's AGI" == "Parent's Income"
        $parsedArgs->parentAdjustedGrossIncome = $parentIncome;

        // ASSUME: Parents are tax filers
        $parsedArgs->areParentsTaxFilers = true;

        $parsedArgs->parentIncomeTaxPaid = $parentIncomeTaxPaid;

        // ASSUME: "Parent's Untaxed Income and Benefits" == "Parent's Other Income"
        $parsedArgs->parentUntaxedIncomeAndBenefits = $parentOtherIncome;

        // ASSUME: "Parent's Additional Financial Information" is zero
        $parsedArgs->parentAdditionalFinancialInfo = 0;

        // ASSUME: "Student's AGI" == "Student's Income"
        $parsedArgs->studentAdjustedGrossIncome = $studentIncome;

        // ASSUME: Student is a tax filer
        $parsedArgs->isStudentTaxFiler = true;

        $parsedArgs->studentIncomeTaxPaid = $studentIncomeTaxPaid;

        // ASSUME: "Student's Untaxed Income and Benefits" == "Student's Other Income"
        $parsedArgs->studentUntaxedIncomeAndBenefits = $studentOtherIncome;

        // ASSUME: "Student's Additional Financial Information" is zero
        $parsedArgs->studentAdditionalFinancialInfo = 0;

        // ASSUME: "Parent's Cash, Savings, and Checking" == "Parent's Assets"
        $parsedArgs->parentCashSavingsChecking = $parentAssets;

        // ASSUME: "Parent's Net Worth of Investments" is zero
        $parsedArgs->parentInvestmentNetWorth = 0;

        // ASSUME: "Parent's Net Worth of Business and/or Investment Farm" is zero
        $parsedArgs->parentBusinessFarmNetWorth = 0;

        // ASSUME: "Student's Cash, Savings, and Checking" == "Student's Assets"
        $parsedArgs->studentCashSavingsChecking = $studentAssets;

        // ASSUME: "Student's Net Worth of Investments" is zero
        $parsedArgs->studentInvestmentNetWorth = 0;

        // ASSUME: "Student's Net Worth of Business and/or Investment Farm" is zero
        $parsedArgs->studentBusinessFarmNetWorth = 0;

        $parsedArgs->maritalStatus = $maritalStatus;
        $parsedArgs->stateOfResidency = $stateOfResidency;
        $parsedArgs->numberInHousehold = $numberInHousehold;
        $parsedArgs->numberInCollege = $numberInCollege;

        // ASSUME: Student is NOT qualified for simplified formula
        $parsedArgs->isQualifiedForSimplified = false;

        // ASSUME: Nine months of enrollment
        $parsedArgs->monthsOfEnrollment = 9;

        return $parsedArgs;
    }

    /**
     * Parses "raw" string values into a IndependentEfcCalculatorArguments object that
     * can be passed to the EfcCalculator. If validation errors occur while parsing the values,
     * they are added to the errors property of this validator
     * @param RawSimpleIndependentEfcCalculatorArguments $args Set of "raw" string arguments to parse
     * @return IndependentEfcCalculatorArguments
     */
    public function validateSimpleIndependentEfcCalculatorArguments($args)
    {
        if ($args == null)
        {
            throw new Exception("No raw arguments provided");
        }

        // Marital Status
        $maritalStatus
            = $this->_validator->validateMaritalStatus(
                $args->maritalStatus,
                self::LabelIndStudentMaritalStatus,
                self::ParamMaritalStatus);

        // Student Age
        $studentAge =
            $this->_validator->validateNonZeroInteger(
                $args->studentAge,
                self::LabelIndStudentAge,
                self::ParamIndStudentAge);

        // Student Income
        $studentIncome =
            $this->_validator->validatePositiveMoneyValue(
                $args->studentIncome,
                self::LabelIndStudentIncome,
                self::ParamIndStudentIncome);

        // Student Other Income
        $studentOtherIncome =
            $this->_validator->validatePositiveMoneyValue(
                $args->studentOtherIncome,
                self::LabelIndStudentOtherIncome,
                self::ParamIndStudentOtherIncome);

        // Student Income Earned By
        $incomeEarnedBy =
            $this->_validator->validateIncomeEarnedBy(
                $args->studentIncomeEarnedBy,
                self::LabelIndStudentIncomeEarnedBy,
                self::ParamIndStudentIncomeEarnedBy);

        // CHECK: If Single/Separated/Divorced, "Student's Income Earned By" can not be "Both"
        if ($maritalStatus == MaritalStatus::SingleSeparatedDivorced && $incomeEarnedBy == IncomeEarnedBy::Both)
        {
            $this->_validator->errors[] = new ValidationError(self::ParamIndStudentIncomeEarnedBy,
                sprintf('%s was "Single/Separated/Divorced", but %s was marked as earned by both student and spouse',
                self::LabelIndStudentMaritalStatus, self::LabelIndStudentIncomeEarnedBy));
        }

        // CHECK: If "Student's Income Earned By" is "None', then "Parent Income" must be 0
        if ($incomeEarnedBy == IncomeEarnedBy::None && $studentIncome > 0)
        {
            $this->_validator->errors[] = new ValidationError(self::ParamParentIncome,
                sprintf('%s was marked as earned by neither student nor spouse, but %s was greater than 0',
                    self::LabelIndStudentIncomeEarnedBy, self::LabelIndStudentIncome));
        }

        // Student Income Tax Paid
        $studentIncomeTaxPaid =
            $this->_validator->validatePositiveMoneyValue(
                $args->studentIncomeTax,
                self::LabelIndStudentIncomeTax,
                self::ParamIndStudentIncomeTax);

        // Student Assets
        $studentAssets =
            $this->_validator->validatePositiveMoneyValue(
                $args->studentAssets,
                self::LabelIndStudentAssets,
                self::ParamIndStudentAssets);

        // Number in Household
        $numberInHousehold =
            $this->_validator->validateNonZeroInteger(
                $args->numberInHousehold,
                self::LabelNumInHousehold,
                self::ParamNumInHousehold);

        // Number in College
        $numberInCollege =
            $this->_validator->validateNonZeroInteger(
                $args->numberInCollege,
                self::LabelNumInCollege,
                self::ParamNumInCollege);

        // CHECK: Number in Household must be greater than or equal to Number in College
        if ($numberInCollege > $numberInHousehold)
        {
            $this->_validator->errors[] = new ValidationError(self::ParamNumInCollege,
                sprintf('%s must be less than or equal to %s',
                self::LabelNumInCollege, self::LabelNumInHousehold));
        }

        // Has Dependents
        $hasDependents =
            $this->_validator->validateBoolean(
                $args->HasDependents,
                self::LabelIndStudentHasDep,
                self::ParamIndStudentHasDep);

        // CHECK: If student has dependents, Number in Household can not be less than two
        if ($hasDependents && $numberInHousehold < 2)
        {
            $this->_validator->errors[] = new ValidationError(self::ParamIndStudentHasDep,
                sprintf('Student has dependents, but %s was less than two.',
                self::LabelNumInHousehold));
        }

        // State of Residency
        $stateOfResidency =
            $this->_validator->validateUnitedStatesStateOrTerritory(
                $args->stateOfResidency, 
                self::LabelStateOfResidency,
                self::ParamStateOfResidency);

        if (count($this->_validator->errors) > 0)
        {
            return null;
        }

        // Build a list of arguments for the full EFC calculation using assumed
        // values gleaned from the "simplified" values provided

        $isStudentWorking = false;
        $isSpouseWorking = false;

        $studentWorkIncome = 0;
        $spouseWorkIncome = 0;

        if($incomeEarnedBy == IncomeEarnedBy::One)
        {
            $isStudentWorking = true;
            $studentWorkIncome = $studentIncome;
        }

        if($incomeEarnedBy == IncomeEarnedBy::Both)
        {
            $isStudentWorking = $isSpouseWorking = true;
            $studentWorkIncome = $spouseWorkIncome = ($studentIncome/2);
        }

        $student = new HouseholdMember();
        $student->isWorking = $isStudentWorking;
        $student->workIncome = $studentWorkIncome;

        $spouse = null;
        if ($maritalStatus == MaritalStatus::MarriedRemarried)
        {
            $spouse = new HouseholdMember();
            $spouse->isWorking = $isSpouseWorking;
            $spouse->workIncome = $spouseWorkIncome;
        }

        $parsedArgs = new IndependentEfcCalculatorArguments();

        $parsedArgs->student = $student;
        $parsedArgs->spouse = $spouse;

        // ASSUME: "Student and Spouse's Income" == "Student and Spouse's AGI"
        $parsedArgs->adjustedGrossIncome = $studentIncome;

        // ASSUME: Student and Spouse are tax filers
        $parsedArgs->areTaxFilers = true;

        $parsedArgs->incomeTaxPaid = $studentIncomeTaxPaid;

        // ASSUME: "Student and Spouse's Untaxed Income and Benefits" == "Student and Spouse's Other Income"
        $parsedArgs->untaxedIncomeAndBenefits = $studentOtherIncome;

        // ASSUME: "Student and Spouse's Additional Financial Information" is zero
        $parsedArgs->additionalFinancialInfo = 0;

        // ASSUME: "Student's and Spouse's Cash, Savings, and Checking" == "Student and Spouse's Assets"
        $parsedArgs->cashSavingsCheckings = $studentAssets;

        // ASSUME: "Student and Spouse's Net Worth of Investments" is zero
        $parsedArgs->investmentNetWorth = 0;

        // ASSUME: "Student and Spouse's Net Worth of Business and/or Investment Farm" is zero
        $parsedArgs->businessFarmNetWorth = 0;

        $parsedArgs->hasDependents = $hasDependents;
        $parsedArgs->maritalStatus = $maritalStatus;
        $parsedArgs->stateOfResidency = $stateOfResidency;
        $parsedArgs->numberInHousehold = $numberInHousehold;
        $parsedArgs->numberInCollege = $numberInCollege;
        $parsedArgs->age = $studentAge;

        // ASSUME: Student is NOT qualified for simplified formula
        $parsedArgs->isQualifiedForSimplified = false;

        // ASSUME: Nine months of enrollment
        $parsedArgs->monthsOfEnrollment = 9;

        return $parsedArgs;
    }
}
?>