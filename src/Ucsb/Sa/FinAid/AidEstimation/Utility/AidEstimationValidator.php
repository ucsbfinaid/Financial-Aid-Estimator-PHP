<?php
namespace Ucsb\Sa\FinAid\AidEstimation\Utility;

class AidEstimationValidator
{
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

    const Param$= "maritalStatus";
    const LabelParent$= '"Parent(s)\' Marital Status"';
    const LabelIndStudent$= '"Student\'s Marital Status"';

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
        $student->isWorking = isStudentWorking;
        $student->workIncome = studentWorkIncome;

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
                self::LabelNumInCollege, self::LabelNumInHousehold)));
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
                = isSpouseWorking
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
                    $args->HasDependents,
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
                self::LabelNumInHousehold)));
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
}
?>