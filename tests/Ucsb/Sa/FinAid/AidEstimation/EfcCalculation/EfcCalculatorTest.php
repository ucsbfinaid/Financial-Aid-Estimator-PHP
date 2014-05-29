<?php
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\AaiContributionCalculator;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\AllowanceCalculator;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\Arguments\DependentEfcCalculatorArguments;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\Arguments\InDependentEfcCalculatorArguments;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\AssetContributionCalculator;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\EfcCalculator;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\HouseholdMember;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\IncomeCalculator;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\MaritalStatus;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\UnitedStatesStateOrTerritory;

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

    public function testGetDependentEfcProfile_NegativeNumberInCollege_ZeroEfc()
    {
        $args = new DependentEfcCalculatorArguments();
        $args->numberInCollege = -1;
        $args->student = new HouseholdMember();
        $args->monthsOfEnrollment = 9;

        $result = $this->_efcCalculator->getDependentEfcProfile($args);
        $this->assertEquals(0, $result->expectedFamilyContribution);
    }

    public function testGetDependentEfcProfile_NoStudent_ZeroEfc()
    {
        $args = new DependentEfcCalculatorArguments();
        $args->numberInCollege =  3;
        $args->student = null;
        $args->monthsOfEnrollment = 9;

        $result = $this->_efcCalculator->getDependentEfcProfile($args);
        $this->assertEquals(0, $result->expectedFamilyContribution);
    }

    public function testGetDependentEfcProfile_LowValues_Calculated()
    {
        $args = new DependentEfcCalculatorArguments();

        $args->firstParent = new HouseholdMember();
        $args->firstParent->isWorking = false;
        $args->firstParent->workIncome = 0;

        $args->secondParent = new HouseholdMember();
        $args->secondParent->isWorking = false;
        $args->secondParent->workIncome = 0;

        $args->student = new HouseholdMember();
        $args->student->isWorking = false;
        $args->student->workIncome = 0;

        $args->parentAdjustedGrossIncome = 0;
        $args->areParentsTaxFilers = false;
        $args->parentIncomeTaxPaid = 0;
        $args->parentUntaxedIncomeAndBenefits = 10000;
        $args->parentAdditionalFinancialInfo = 0;
        $args->studentAdjustedGrossIncome = 0;
        $args->isStudentTaxFiler = false;
        $args->studentIncomeTaxPaid = 0;
        $args->studentUntaxedIncomeAndBenefits = 0;
        $args->studentAdditionalFinancialInfo = 0;
        $args->parentCashSavingsChecking = 0;
        $args->parentInvestmentNetWorth = 0;
        $args->parentBusinessFarmNetWorth = 0;
        $args->studentCashSavingsChecking = 0;
        $args->studentInvestmentNetWorth = 0;
        $args->maritalStatus = MaritalStatus::MarriedRemarried;
        $args->stateOfResidency = UnitedStatesStateOrTerritory::California;
        $args->numberInHousehold = 3;
        $args->numberInCollege =  1;
        $args->oldestParentAge = 30;
        $args->monthsOfEnrollment = 9;

        $profile = $this->_efcCalculator->getDependentEfcProfile($args);
        $this->assertEquals(0, $profile->expectedFamilyContribution);
    }

    public function testGetDependentEfcProfile_ParentTotalIncome_Calculated()
    {
        $args = new DependentEfcCalculatorArguments();

        $args->firstParent = new HouseholdMember();
        $args->firstParent->isWorking = false;
        $args->firstParent->workIncome = 0;

        $args->secondParent = new HouseholdMember();
        $args->secondParent->isWorking = false;
        $args->secondParent->workIncome = 0;

        $args->student = new HouseholdMember();
        $args->student->isWorking = false;
        $args->student->workIncome = 0;

        $args->parentAdjustedGrossIncome = 0;
        $args->areParentsTaxFilers = false;
        $args->parentIncomeTaxPaid = 0;
        $args->parentUntaxedIncomeAndBenefits = 10000;
        $args->parentAdditionalFinancialInfo = 0;
        $args->studentAdjustedGrossIncome = 0;
        $args->isStudentTaxFiler = false;
        $args->studentIncomeTaxPaid = 0;
        $args->studentUntaxedIncomeAndBenefits = 0;
        $args->studentAdditionalFinancialInfo = 0;
        $args->parentCashSavingsChecking = 0;
        $args->parentInvestmentNetWorth = 0;
        $args->parentBusinessFarmNetWorth = 0;
        $args->studentCashSavingsChecking = 0;
        $args->studentInvestmentNetWorth = 0;
        $args->maritalStatus = MaritalStatus::MarriedRemarried;
        $args->stateOfResidency = UnitedStatesStateOrTerritory::California;
        $args->numberInHousehold = 3;
        $args->numberInCollege = 1;
        $args->oldestParentAge = 30;
        $args->monthsOfEnrollment = 9;

        $profile = $this->_efcCalculator->getDependentEfcProfile($args);
        $this->assertEquals(10000, $profile->parentTotalIncome);
    }

    public function testGetDependentEfcProfile_Values_Calculated()
    {
        $args = new DependentEfcCalculatorArguments();

        $args->firstParent = null;

        $args->secondParent = new HouseholdMember();
        $args->secondParent->isWorking = true;
        $args->secondParent->workIncome = 60000;

        $args->student = new HouseholdMember();
        $args->student->isWorking = true;
        $args->student->workIncome = 10000;

        $args->parentAdjustedGrossIncome = 60000;
        $args->areParentsTaxFilers = true;
        $args->parentIncomeTaxPaid = 6000;
        $args->parentUntaxedIncomeAndBenefits = 1000;
        $args->parentAdditionalFinancialInfo = 200;
        $args->studentAdjustedGrossIncome = 10000;
        $args->isStudentTaxFiler = true;
        $args->studentIncomeTaxPaid = 1000;
        $args->studentUntaxedIncomeAndBenefits = 0;
        $args->studentAdditionalFinancialInfo = 0;
        $args->parentCashSavingsChecking = 80000;
        $args->parentInvestmentNetWorth = 5000;
        $args->parentBusinessFarmNetWorth = 0;
        $args->studentCashSavingsChecking = 3000;
        $args->studentInvestmentNetWorth = 0;
        $args->maritalStatus = MaritalStatus::SingleSeparatedDivorced;
        $args->stateOfResidency = UnitedStatesStateOrTerritory::California;
        $args->numberInHousehold = 3;
        $args->numberInCollege = 1;
        $args->oldestParentAge = 45;
        $args->monthsOfEnrollment = 9;

        $profile = $this->_efcCalculator->getDependentEfcProfile($args);
        $this->assertEquals(9278, $profile->expectedFamilyContribution);
    }

    public function testGetDependentEfcProfile_HighValues_Calculated()
    {
        $args = new DependentEfcCalculatorArguments();

        $args->firstParent = new HouseholdMember();
        $args->firstParent->isWorking = true;
        $args->firstParent->workIncome = 600000;

        $args->secondParent = new HouseholdMember();
        $args->secondParent->isWorking = true;
        $args->secondParent->workIncome = 600000;

        $args->student = new HouseholdMember();
        $args->student->isWorking = true;
        $args->student->workIncome = 20000;

        $args->parentAdjustedGrossIncome = 1200000;
        $args->areParentsTaxFilers = true;
        $args->parentIncomeTaxPaid = 120000;
        $args->parentUntaxedIncomeAndBenefits = 10000;
        $args->parentAdditionalFinancialInfo = 2000;
        $args->studentAdjustedGrossIncome = 20000;
        $args->isStudentTaxFiler = true;
        $args->studentIncomeTaxPaid = 2000;
        $args->studentUntaxedIncomeAndBenefits = 0;
        $args->studentAdditionalFinancialInfo = 0;
        $args->parentCashSavingsChecking = 100000;
        $args->parentInvestmentNetWorth = 8000;
        $args->parentBusinessFarmNetWorth = 9000;
        $args->studentCashSavingsChecking = 6000;
        $args->studentInvestmentNetWorth = 1000;
        $args->maritalStatus = MaritalStatus::MarriedRemarried;
        $args->stateOfResidency = UnitedStatesStateOrTerritory::California;
        $args->numberInHousehold =  20;
        $args->numberInCollege =  10;
        $args->oldestParentAge = 45;
        $args->monthsOfEnrollment = 9;

        $profile = $this->_efcCalculator->getDependentEfcProfile($args);
        $this->assertEquals(48227, $profile->expectedFamilyContribution);
    }

    public function testGetIndependentEfcProfile_ZeroNumberInCollege_ZeroEfc()
    {
        $args = new IndependentEfcCalculatorArguments();

        $args->numberInCollege =  0;
        $args->student = new HouseholdMember();

        $result = $this->_efcCalculator->getIndependentEfcProfile($args);
        $this->assertEquals(0, $result->expectedFamilyContribution);
    }

    public function testGetIndependentEfcProfile_NegativeNumberInCollege_ZeroEfc()
    {
        $args = new IndependentEfcCalculatorArguments();

        $args->numberInCollege =  -1;
        $args->student = new HouseholdMember();

        $result = $this->_efcCalculator->getIndependentEfcProfile($args);
        $this->assertEquals(0, $result->expectedFamilyContribution);
    }

    public function testGetIndependentEfcProfile_NoStudent_ZeroEfc()
    {
        $args = new IndependentEfcCalculatorArguments();

        $args->numberInCollege =  3;
        $args->student = null;

        $result = $this->_efcCalculator->getIndependentEfcProfile($args);
        $this->assertEquals(0, $result->expectedFamilyContribution);
    }

    public function testGetIndependentEfcProfile_LowValues_Calculated()
    {
        $args = new IndependentEfcCalculatorArguments();

        $args->student = new HouseholdMember();
        $args->student->isWorking = false;
        $args->student->workIncome = 0;

        $args->spouse= new HouseholdMember();
        $args->spouse->isWorking = false;
        $args->spouse->workIncome = 0;

        $args->adjustedGrossIncome = 0;
        $args->areTaxFilers = false;
        $args->incomeTaxPaid = 0;
        $args->untaxedIncomeAndBenefits = 10000;
        $args->additionalFinancialInfo = 0;
        $args->cashSavingsCheckings = 0;
        $args->investmentNetWorth = 0;
        $args->businessFarmNetWorth = 0;
        $args->hasDependents = false;
        $args->maritalStatus = MaritalStatus::MarriedRemarried;
        $args->stateOfResidency = UnitedStatesStateOrTerritory::AmericanSamoa;
        $args->numberInHousehold =  2;
        $args->numberInCollege =  1;
        $args->age = 25;
        $args->monthsOfEnrollment = 9;

        $profile = $this->_efcCalculator->getIndependentEfcProfile($args);
        $this->assertEquals(0, $profile->expectedFamilyContribution);
    }

    public function testGetIndependentEfcProfile_Values_Calculated()
    {
        $args = new IndependentEfcCalculatorArguments();
        
        $args->student = new HouseholdMember();
        $args->student->isWorking = true;
        $args->student->workIncome = 60000;

        $args->spouse= null;

        $args->adjustedGrossIncome = 60000;
        $args->areTaxFilers = true;
        $args->incomeTaxPaid = 6000;
        $args->untaxedIncomeAndBenefits = 1000;
        $args->additionalFinancialInfo = 200;
        $args->cashSavingsCheckings = 80000;
        $args->investmentNetWorth = 5000;
        $args->businessFarmNetWorth = 0;
        $args->hasDependents = false;
        $args->maritalStatus = MaritalStatus::SingleSeparatedDivorced;
        $args->stateOfResidency = UnitedStatesStateOrTerritory::Alabama;
        $args->numberInHousehold =  1;
        $args->numberInCollege =  1;
        $args->age = 25;
        $args->monthsOfEnrollment = 9;

        $profile = $this->_efcCalculator->getIndependentEfcProfile($args);
        $this->assertEquals(36727, $profile->expectedFamilyContribution);
    }

    public function testGetIndependentEfcProfile_HighValues_Calculated()
    {
        $args = new IndependentEfcCalculatorArguments();

        $args->student = new HouseholdMember();
        $args->student->isWorking = true;
        $args->student->workIncome = 600000;

        $args->spouse = new HouseholdMember();
        $args->spouse->isWorking = true;
        $args->spouse->workIncome = 600000;

        $args->adjustedGrossIncome = 1200000;
        $args->areTaxFilers = true;
        $args->incomeTaxPaid = 6000;
        $args->untaxedIncomeAndBenefits = 10000;
        $args->additionalFinancialInfo = 2000;
        $args->cashSavingsCheckings = 100000;
        $args->investmentNetWorth = 8000;
        $args->businessFarmNetWorth = 9000;
        $args->hasDependents = false;
        $args->maritalStatus = MaritalStatus::MarriedRemarried;
        $args->stateOfResidency = UnitedStatesStateOrTerritory::Alaska;
        $args->numberInHousehold =  2;
        $args->numberInCollege =  2;
        $args->age = 30;
        $args->monthsOfEnrollment = 9;

        $profile = $this->_efcCalculator->getIndependentEfcProfile($args);
        $this->assertEquals(299467, $profile->expectedFamilyContribution);
    }

    public function testGetIndependentEfcProfile_HasDependentsLowValues_Calculated()
    {
        $args = new IndependentEfcCalculatorArguments();

        $args->student = new HouseholdMember();

        $args->student->isWorking = false;
        $args->student->workIncome = 0;

        $args->spouse= new HouseholdMember();

        $args->spouse->isWorking = false;
        $args->spouse->workIncome = 0;

        $args->adjustedGrossIncome = 0;
        $args->areTaxFilers = false;
        $args->incomeTaxPaid = 0;
        $args->untaxedIncomeAndBenefits = 10000;
        $args->additionalFinancialInfo = 0;
        $args->cashSavingsCheckings = 0;
        $args->investmentNetWorth = 0;
        $args->businessFarmNetWorth = 0;
        $args->hasDependents = true;
        $args->maritalStatus = MaritalStatus::MarriedRemarried;
        $args->stateOfResidency = UnitedStatesStateOrTerritory::AmericanSamoa;
        $args->numberInHousehold =  3;
        $args->numberInCollege =  1;
        $args->age = 25;
        $args->monthsOfEnrollment = 9;

        $profile = $this->_efcCalculator->getIndependentEfcProfile($args);
        $this->assertEquals(0, $profile->expectedFamilyContribution);
    }

    public function testGetIndependentEfcProfile_HasDependentsValues_Calculated()
    {
        $args = new IndependentEfcCalculatorArguments();

        $args->student = new HouseholdMember();
        $args->student->isWorking = true;
        $args->student->workIncome = 60000;

        $args->spouse = null;

        $args->adjustedGrossIncome = 60000;
        $args->areTaxFilers = true;
        $args->incomeTaxPaid = 6000;
        $args->untaxedIncomeAndBenefits = 1000;
        $args->additionalFinancialInfo = 200;
        $args->cashSavingsCheckings = 80000;
        $args->investmentNetWorth = 5000;
        $args->businessFarmNetWorth = 0;
        $args->hasDependents = true;
        $args->maritalStatus = MaritalStatus::SingleSeparatedDivorced;
        $args->stateOfResidency = UnitedStatesStateOrTerritory::Alabama;
        $args->numberInHousehold =  2;
        $args->numberInCollege =  1;
        $args->age = 25;
        $args->monthsOfEnrollment = 9;

        $profile = $this->_efcCalculator->getIndependentEfcProfile($args);
        $this->assertEquals(6762, $profile->expectedFamilyContribution);
    }

    public function testGetIndependentEfcProfile_HasDependentsHighValues_Calculated()
    {
        $args = new IndependentEfcCalculatorArguments();

        $args->student = new HouseholdMember();
        $args->student->isWorking = true;
        $args->student->workIncome = 600000;

        $args->spouse= new HouseholdMember();
        $args->spouse->isWorking = true;
        $args->spouse->workIncome = 600000;

        $args->adjustedGrossIncome = 1200000;
        $args->areTaxFilers = true;
        $args->incomeTaxPaid = 6000;
        $args->untaxedIncomeAndBenefits = 10000;
        $args->additionalFinancialInfo = 2000;
        $args->cashSavingsCheckings = 100000;
        $args->investmentNetWorth = 8000;
        $args->businessFarmNetWorth = 350000;
        $args->hasDependents = true;
        $args->maritalStatus = MaritalStatus::MarriedRemarried;
        $args->stateOfResidency = UnitedStatesStateOrTerritory::Alaska;
        $args->numberInHousehold =  20;
        $args->numberInCollege =  10;
        $args->age = 30;
        $args->monthsOfEnrollment = 9;

        $profile = $this->_efcCalculator->getIndependentEfcProfile($args);
        $this->assertEquals(50052, $profile->expectedFamilyContribution);
    }

    public function testGetDependentEfcProfile_SimplifiedHighAssets_Calculated()
    {
        $args = new DependentEfcCalculatorArguments();

        $args->firstParent = new HouseholdMember();
        $args->firstParent->isWorking = true;
        $args->firstParent->workIncome = 25000;

        $args->secondParent = new HouseholdMember();
        $args->secondParent->isWorking = true;
        $args->secondParent->workIncome = 24999;

        $args->student = new HouseholdMember();
        $args->student->isWorking = false;
        $args->student->workIncome = 0;

        $args->parentAdjustedGrossIncome = 49999;
        $args->areParentsTaxFilers = false;
        $args->parentIncomeTaxPaid = 0;
        $args->parentUntaxedIncomeAndBenefits = 0;
        $args->parentAdditionalFinancialInfo = 0;
        $args->studentAdjustedGrossIncome = 0;
        $args->isStudentTaxFiler = false;
        $args->studentIncomeTaxPaid = 0;
        $args->studentUntaxedIncomeAndBenefits = 0;
        $args->studentAdditionalFinancialInfo = 0;
        $args->parentCashSavingsChecking = 123456789;
        $args->parentInvestmentNetWorth = 123456789;
        $args->parentBusinessFarmNetWorth = 123456789;
        $args->studentCashSavingsChecking = 123456789;
        $args->studentInvestmentNetWorth = 123456789;
        $args->maritalStatus = MaritalStatus::MarriedRemarried;
        $args->stateOfResidency = UnitedStatesStateOrTerritory::California;
        $args->numberInHousehold =  3;
        $args->numberInCollege =  1;
        $args->oldestParentAge = 30;
        $args->isQualifiedForSimplified = true;
        $args->monthsOfEnrollment = 9;

        $profile = $this->_efcCalculator->getDependentEfcProfile($args);
        $this->assertEquals(3912, $profile->expectedFamilyContribution);
    }

    public function testGetIndependentEfcProfile_SimplifiedHighAssets_Calculated()
    {
        $args = new IndependentEfcCalculatorArguments();

        $args->student = new HouseholdMember();
        $args->student->isWorking = true;
        $args->student->workIncome = 25000;

        $args->spouse= new HouseholdMember();
        $args->spouse->isWorking = true;
        $args->spouse->workIncome = 24999;

        $args->adjustedGrossIncome = 49999;
        $args->areTaxFilers = false;
        $args->incomeTaxPaid = 6000;
        $args->untaxedIncomeAndBenefits = 0;
        $args->additionalFinancialInfo = 0;
        $args->cashSavingsCheckings = 123456789;
        $args->investmentNetWorth = 123456789;
        $args->businessFarmNetWorth = 350000;
        $args->hasDependents = true;
        $args->maritalStatus = MaritalStatus::MarriedRemarried;
        $args->stateOfResidency = UnitedStatesStateOrTerritory::Alaska;
        $args->numberInHousehold =  3;
        $args->numberInCollege =  1;
        $args->age = 30;
        $args->isQualifiedForSimplified = true;
        $args->monthsOfEnrollment = 9;

        $profile = $this->_efcCalculator->getIndependentEfcProfile($args);
        $this->assertEquals(1255, $profile->expectedFamilyContribution);
    }

    public function testGetDependentEfcProfile_AutoZero_Calculated()
    {
        $args = new DependentEfcCalculatorArguments();

        $args->firstParent = new HouseholdMember();
        $args->firstParent->isWorking = true;
        $args->firstParent->workIncome = 11500;

        $args->secondParent = new HouseholdMember();
        $args->secondParent->isWorking = true;
        $args->secondParent->workIncome = 11500;

        $args->student = new HouseholdMember();
        $args->student->isWorking = false;
        $args->student->workIncome = 0;

        $args->parentAdjustedGrossIncome = 32000;
        $args->areParentsTaxFilers = false;
        $args->parentIncomeTaxPaid = 0;
        $args->parentUntaxedIncomeAndBenefits = 0;
        $args->parentAdditionalFinancialInfo = 0;
        $args->studentAdjustedGrossIncome = 0;
        $args->isStudentTaxFiler = false;
        $args->studentIncomeTaxPaid = 0;
        $args->studentUntaxedIncomeAndBenefits = 0;
        $args->studentAdditionalFinancialInfo = 0;
        $args->parentCashSavingsChecking = 123456789;
        $args->parentInvestmentNetWorth = 123456789;
        $args->parentBusinessFarmNetWorth = 123456789;
        $args->studentCashSavingsChecking = 123456789;
        $args->studentInvestmentNetWorth = 123456789;
        $args->maritalStatus = MaritalStatus::MarriedRemarried;
        $args->stateOfResidency = UnitedStatesStateOrTerritory::California;
        $args->numberInHousehold =  3;
        $args->numberInCollege =  1;
        $args->oldestParentAge = 30;
        $args->isQualifiedForSimplified = true;
        $args->monthsOfEnrollment = 9;

        $profile = $this->_efcCalculator->getDependentEfcProfile($args);
        $this->assertEquals(0, $profile->expectedFamilyContribution);
    }

    public function testGetIndependentEfcProfile_AutoZero_Calculated()
    {
        $args = new IndependentEfcCalculatorArguments();

        $args->student = new HouseholdMember();
        $args->student->isWorking = true;
        $args->student->workIncome = 11500;

        $args->spouse= new HouseholdMember();
        $args->spouse->isWorking = true;
        $args->spouse->workIncome = 11500;

        $args->adjustedGrossIncome = 32000;
        $args->areTaxFilers = false;
        $args->incomeTaxPaid = 6000;
        $args->untaxedIncomeAndBenefits = 999999999999;
        $args->additionalFinancialInfo = 0;
        $args->cashSavingsCheckings = 123456789;
        $args->investmentNetWorth = 123456789;
        $args->businessFarmNetWorth = 350000;
        $args->hasDependents = true;
        $args->maritalStatus = MaritalStatus::MarriedRemarried;
        $args->stateOfResidency = UnitedStatesStateOrTerritory::Alaska;
        $args->numberInHousehold =  3;
        $args->numberInCollege =  1;
        $args->age = 30;
        $args->isQualifiedForSimplified = true;
        $args->monthsOfEnrollment = 9;

        $profile = $this->_efcCalculator->getIndependentEfcProfile($args);
        $this->assertEquals(0, $profile->expectedFamilyContribution);
    }

    public function testGetDependentEfcProfile_NoMonthsOfEnrollment_Calculated()
    {
        $args = new DependentEfcCalculatorArguments();

        $args->firstParent = null;

        $args->secondParent = new HouseholdMember();
        $args->secondParent->isWorking = true;
        $args->secondParent->workIncome = 60000;

        $args->student = new HouseholdMember();
        $args->student->isWorking = true;
        $args->student->workIncome = 10000;

        $args->parentAdjustedGrossIncome = 60000;
        $args->areParentsTaxFilers = true;
        $args->parentIncomeTaxPaid = 6000;
        $args->parentUntaxedIncomeAndBenefits = 1000;
        $args->parentAdditionalFinancialInfo = 200;
        $args->studentAdjustedGrossIncome = 10000;
        $args->isStudentTaxFiler = true;
        $args->studentIncomeTaxPaid = 1000;
        $args->studentUntaxedIncomeAndBenefits = 0;
        $args->studentAdditionalFinancialInfo = 0;
        $args->parentCashSavingsChecking = 80000;
        $args->parentInvestmentNetWorth = 5000;
        $args->parentBusinessFarmNetWorth = 0;
        $args->studentCashSavingsChecking = 3000;
        $args->studentInvestmentNetWorth = 0;
        $args->maritalStatus = MaritalStatus::SingleSeparatedDivorced;
        $args->stateOfResidency = UnitedStatesStateOrTerritory::California;
        $args->numberInHousehold =  3;
        $args->numberInCollege =  1;
        $args->oldestParentAge = 45;
        $args->monthsOfEnrollment = 0;

        $profile = $this->_efcCalculator->getDependentEfcProfile($args);
        $this->assertEquals(0, $profile->expectedFamilyContribution);
    }

    public function testGetDependentEfcProfile_ThreeMonthsEnrollment_Calculated()
    {
        $args = new DependentEfcCalculatorArguments();

        $args->firstParent = null;

        $args->secondParent = new HouseholdMember();
        $args->secondParent->isWorking = true;
        $args->secondParent->workIncome = 60000;

        $args->student = new HouseholdMember();
        $args->student->isWorking = true;
        $args->student->workIncome = 10000;

        $args->parentAdjustedGrossIncome = 60000;
        $args->areParentsTaxFilers = true;
        $args->parentIncomeTaxPaid = 6000;
        $args->parentUntaxedIncomeAndBenefits = 1000;
        $args->parentAdditionalFinancialInfo = 200;
        $args->studentAdjustedGrossIncome = 10000;
        $args->isStudentTaxFiler = true;
        $args->studentIncomeTaxPaid = 1000;
        $args->studentUntaxedIncomeAndBenefits = 0;
        $args->studentAdditionalFinancialInfo = 0;
        $args->parentCashSavingsChecking = 80000;
        $args->parentInvestmentNetWorth = 5000;
        $args->parentBusinessFarmNetWorth = 0;
        $args->studentCashSavingsChecking = 3000;
        $args->studentInvestmentNetWorth = 0;
        $args->maritalStatus = MaritalStatus::SingleSeparatedDivorced;
        $args->stateOfResidency = UnitedStatesStateOrTerritory::California;
        $args->numberInHousehold =  3;
        $args->numberInCollege =  1;
        $args->oldestParentAge = 45;
        $args->monthsOfEnrollment = 3;

        $profile = $this->_efcCalculator->getDependentEfcProfile($args);
        $this->assertEquals(2625, $profile->parentContribution);
        $this->assertEquals(867, $profile->studentContribution);
    }

    public function testGetDependentEfcProfile_TwelveMonthsEnrollment_Calculated()
    {
        $args = new DependentEfcCalculatorArguments();

        $args->firstParent = null;

        $args->secondParent = new HouseholdMember();
        $args->secondParent->isWorking = true;
        $args->secondParent->workIncome = 60000;

        $args->student = new HouseholdMember();
        $args->student->isWorking = true;
        $args->student->workIncome = 10000;

        $args->parentAdjustedGrossIncome = 60000;
        $args->areParentsTaxFilers = true;
        $args->parentIncomeTaxPaid = 6000;
        $args->parentUntaxedIncomeAndBenefits = 1000;
        $args->parentAdditionalFinancialInfo = 200;
        $args->studentAdjustedGrossIncome = 10000;
        $args->isStudentTaxFiler = true;
        $args->studentIncomeTaxPaid = 1000;
        $args->studentUntaxedIncomeAndBenefits = 0;
        $args->studentAdditionalFinancialInfo = 0;
        $args->parentCashSavingsChecking = 80000;
        $args->parentInvestmentNetWorth = 5000;
        $args->parentBusinessFarmNetWorth = 0;
        $args->studentCashSavingsChecking = 3000;
        $args->studentInvestmentNetWorth = 0;
        $args->maritalStatus = MaritalStatus::SingleSeparatedDivorced;
        $args->stateOfResidency = UnitedStatesStateOrTerritory::California;
        $args->numberInHousehold =  3;
        $args->numberInCollege =  1;
        $args->oldestParentAge = 45;
        $args->monthsOfEnrollment = 12;

        $profile = $this->_efcCalculator->getDependentEfcProfile($args);
        $this->assertEquals(8409, $profile->parentContribution);
        $this->assertEquals(1403, $profile->studentContribution);
    }

    public function testGetIndependentEfcProfile_NoMonthsOfEnrollment_Calculated()
    {
        $args = new IndependentEfcCalculatorArguments();

        $args->student = new HouseholdMember();
        $args->student->isWorking = true;
        $args->student->workIncome = 60000;

        $args->spouse= null;

        $args->adjustedGrossIncome = 60000;
        $args->areTaxFilers = true;
        $args->incomeTaxPaid = 6000;
        $args->untaxedIncomeAndBenefits = 1000;
        $args->additionalFinancialInfo = 200;
        $args->cashSavingsCheckings = 80000;
        $args->investmentNetWorth = 5000;
        $args->businessFarmNetWorth = 0;
        $args->hasDependents = false;
        $args->maritalStatus = MaritalStatus::SingleSeparatedDivorced;
        $args->stateOfResidency = UnitedStatesStateOrTerritory::Alabama;
        $args->numberInHousehold =  1;
        $args->numberInCollege =  1;
        $args->age = 25;
        $args->monthsOfEnrollment = 0;

        $profile = $this->_efcCalculator->getIndependentEfcProfile($args);
        $this->assertEquals(0, $profile->expectedFamilyContribution);
    }

    public function testGetIndependentEfcProfile_ThreeMonthsEnrollment_Calculated()
    {
        $args = new IndependentEfcCalculatorArguments();

        $args->student = new HouseholdMember();
        $args->student->isWorking = true;
        $args->student->workIncome = 60000;

        $args->spouse= null;

        $args->adjustedGrossIncome = 60000;
        $args->areTaxFilers = true;
        $args->incomeTaxPaid = 6000;
        $args->untaxedIncomeAndBenefits = 1000;
        $args->additionalFinancialInfo = 200;
        $args->cashSavingsCheckings = 80000;
        $args->investmentNetWorth = 5000;
        $args->businessFarmNetWorth = 0;
        $args->hasDependents = false;
        $args->maritalStatus = MaritalStatus::SingleSeparatedDivorced;
        $args->stateOfResidency = UnitedStatesStateOrTerritory::Alabama;
        $args->numberInHousehold =  1;
        $args->numberInCollege =  1;
        $args->age = 25;
        $args->monthsOfEnrollment = 3;

        $profile = $this->_efcCalculator->getIndependentEfcProfile($args);
        $this->assertEquals(12243, $profile->expectedFamilyContribution);
    }
}
?>