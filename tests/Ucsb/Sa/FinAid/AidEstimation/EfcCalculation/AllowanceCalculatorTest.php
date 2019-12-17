<?php
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\AllowanceCalculator;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\Constants\AllowanceCalculatorConstants;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\EfcCalculationRole;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\HouseholdMember;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\MaritalStatus;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\UnitedStatesStateOrTerritory;

require_once 'TestConstantsFactory.php';

class AllowanceCalculatorTest extends \PHPUnit_Framework_TestCase
{
	private $_allowanceCalculator;

	protected function setUp()
	{
        $this->_allowanceCalculator = new AllowanceCalculator(TestConstantsFactory::getAllowanceCalculatorConstants());
	}

	function testCalculateIncomeTaxAllowance_Value_Calculated()
	{
		$result = $this->_allowanceCalculator->calculateIncomeTaxAllowance(1000);
		$this->assertEquals(1000, $result);
	}

    function testCalculateIncomeTaxAllowance_NegativeValue_EqualsZero()
    {
        $result = $this->_allowanceCalculator->calculateIncomeTaxAllowance(-1000);
        $this->assertEquals(0, $result);
    }

    function testCalculateIncomeTaxAllowance_DecimalValue_Rounded()
    {
        $result = $this->_allowanceCalculator->calculateIncomeTaxAllowance(2000.55);
        $this->assertEquals(2001, $result);
    }

    function testCalculateStateTaxAllowance_HighStateTaxPercent_Calculated()
    {
        $result = $this->_allowanceCalculator->calculateStateTaxAllowance(EfcCalculationRole::Parent, UnitedStatesStateOrTerritory::California, 14999);
        $this->assertEquals(1200, $result);
    }

    function testCalculateStateTaxAllowance_LowStateTaxPercent_Calculated()
    {
        $result = $this->_allowanceCalculator->calculateStateTaxAllowance(EfcCalculationRole::Parent, UnitedStatesStateOrTerritory::California, 15000);
        $this->assertEquals(1050, $result);
    }
    
    function testCalculateStateTaxAllowance_NegativeTotalIncome_EqualsZero()
    {
        $result = $this->_allowanceCalculator->calculateStateTaxAllowance(EfcCalculationRole::Parent, UnitedStatesStateOrTerritory::California, -15000);
        $this->assertEquals(0, $result);
    }

    function testCalculateStateTaxAllowance_DependentStudent_Calculated()
    {
        $result = $this->_allowanceCalculator->calculateStateTaxAllowance(EfcCalculationRole::DependentStudent, UnitedStatesStateOrTerritory::California, 3000);
        $this->assertEquals(180, $result);
    }

    function testCalculateStateTaxAllowance_IndependentStudentWithDep_Calculated()
    {
        $result = $this->_allowanceCalculator->calculateStateTaxAllowance(EfcCalculationRole::IndependentStudentWithDependents, UnitedStatesStateOrTerritory::California, 3000);
        $this->assertEquals(240, $result);
    }
    
    function testCalculateStateTaxAllowance_IndependentStudentWithoutDep_Calculated()
    {
        $result = $this->_allowanceCalculator->calculateStateTaxAllowance(EfcCalculationRole::IndependentStudentWithoutDependents, UnitedStatesStateOrTerritory::California, 3000);
        $this->assertEquals(180, $result);
    }

    function testCalculateStateTaxAllowance_DecimalValue_Rounded()
    {
        $result = $this->_allowanceCalculator->calculateStateTaxAllowance(EfcCalculationRole::Parent, UnitedStatesStateOrTerritory::California, 3000.55);
        $this->assertEquals(240, $result);
    }

    function testCalculateSocialSecurityTaxAllowance_LowRange_Calculated()
    {
        $result = $this->_allowanceCalculator->calculateSocialSecurityTaxAllowance(106800);
        $this->assertEquals(8170, $result);
    }

    function testCalculateSocialSecurityTaxAllowance_MidRange_Calculated()
    {
        $result = $this->_allowanceCalculator->calculateSocialSecurityTaxAllowance(136000);
        $this->assertEquals(9933, $result);
    }
    
    function testCalculateSocialSecurityTaxAllowance_HighRange_Calculated()
    {
        $result = $this->_allowanceCalculator->calculateSocialSecurityTaxAllowance(206800);
        $this->assertEquals(11021, $result);
    }

    function testCalculateSocialSecurityTaxAllowance_NegativeValue_EqualsZero()
    {
        $result = $this->_allowanceCalculator->calculateSocialSecurityTaxAllowance(-206800);
        $this->assertEquals(0, $result);
    }
    
    function testCalculateSocialSecurityTaxAllowance_DecimalValue_Rounded()
    {
        $result = $this->_allowanceCalculator->calculateSocialSecurityTaxAllowance(206800.56);
        $this->assertEquals(11021, $result);
    }

    function testCalculateIncomeProtectionAllowance_ZeroValue_EqualsZero()
    {
        $result = $this->_allowanceCalculator
            ->calculateIncomeProtectionAllowance(EfcCalculationRole::Parent, MaritalStatus::MarriedRemarried, 0, 0);
        $this->assertEquals(0, $result);
    }

    function testCalculateIncomeProtectionAllowance_Value_Calculated()
    {
        $result = $this->_allowanceCalculator
            ->calculateIncomeProtectionAllowance(EfcCalculationRole::Parent, MaritalStatus::MarriedRemarried, 2, 3);
        $this->assertEquals(20510, $result);
    }

    function testCalculateIncomeProtectionAllowance_TooManyInCollege_EqualsZero()
    {
        $result = $this->_allowanceCalculator
            ->calculateIncomeProtectionAllowance(EfcCalculationRole::Parent, MaritalStatus::MarriedRemarried, 6, 3);
        $this->assertEquals(0, $result);
    }

    function testCalculateIncomeProtectionAllowance_AddtlHousehold_Calculated()
    {
        $result = $this->_allowanceCalculator
            ->calculateIncomeProtectionAllowance(EfcCalculationRole::Parent, MaritalStatus::MarriedRemarried, 5, 20);
        $this->assertEquals(93970, $result);
    }

    function testCalculateIncomeProtectionAllowance_AddtlCollege_Calculated()
    {
        $result = $this->_allowanceCalculator
            ->calculateIncomeProtectionAllowance(EfcCalculationRole::Parent, MaritalStatus::MarriedRemarried, 10, 20);
        $this->assertEquals(77720, $result);
    }

    function testCalculateIncomeProtectionAllowance_IndependentStudentWithDep_Calculated()
    {
        $result = $this->_allowanceCalculator
            ->calculateIncomeProtectionAllowance(EfcCalculationRole::IndependentStudentWithDependents, MaritalStatus::MarriedRemarried, 10, 20);
        $this->assertEquals(106190, $result);
    }

    function testCalculateIncomeProtectionAllowance_IndependentStudentWithoutDep_Calculated()
    {
        $result = $this->_allowanceCalculator
            ->calculateIncomeProtectionAllowance(EfcCalculationRole::IndependentStudentWithoutDependents, MaritalStatus::MarriedRemarried, 1, 1);
        $this->assertEquals(17060, $result);
    }

    function testCalculateIncomeProtectionAllowance_SingleIndependentStudentWithoutDep_Calculated()
    {
        $result = $this->_allowanceCalculator
            ->calculateIncomeProtectionAllowance(EfcCalculationRole::IndependentStudentWithoutDependents, MaritalStatus::SingleSeparatedDivorced, 1, 1);
        $this->assertEquals(10640, $result);
    }

    function testCalculateIncomeProtectionAllowance_SingleIndependentStudentWithoutDepWithSpouseInCollege_Calculated()
    {
        $result = $this->_allowanceCalculator
            ->calculateIncomeProtectionAllowance(EfcCalculationRole::IndependentStudentWithoutDependents, MaritalStatus::MarriedRemarried, 2, 2);
        $this->assertEquals(10640, $result);
    }


    function testCalculateIncomeProtectionAllowance_DependentStudent_Calculated()
    {
        $result = $this->_allowanceCalculator->calculateIncomeProtectionAllowance(EfcCalculationRole::DependentStudent, MaritalStatus::MarriedRemarried, 10, 20);
        $this->assertEquals(6840, $result);
    }

    function testCalculateEmploymentExpenseAllowance_TwoWorkingIncomeOverThreshold_Calculated()
    {
        $parents = array();

        $parent1 = new HouseholdMember();
        $parent1->isWorking = true;
        $parent1->workIncome = 20000;
        $parents[] = $parent1;

		$parent2 = new HouseholdMember();
        $parent2->isWorking = true;
        $parent2->workIncome = 40000;
        $parents[] = $parent2;

        $result = $this->_allowanceCalculator
            ->calculateEmploymentExpenseAllowance(EfcCalculationRole::Parent, MaritalStatus::MarriedRemarried, $parents);
        $this->assertEquals(4000, $result);
    }

    function testCalculateEmploymentExpenseAllowance_TwoWorkingIncomeUnderThreshold_Calculated()
    {
        $parents = array();

        $parent1 = new HouseholdMember();
        $parent1->isWorking = true;
        $parent1->workIncome = 2000;
        $parents[] = $parent1;

		$parent2 = new HouseholdMember();
        $parent2->isWorking = true;
        $parent2->workIncome = 4000;
        $parents[] = $parent2;

        $result = $this->_allowanceCalculator
            ->calculateEmploymentExpenseAllowance(EfcCalculationRole::Parent, MaritalStatus::MarriedRemarried, $parents);
        $this->assertEquals(700, $result);
    }

    function testCalculateEmploymentExpenseAllowance_OneParent_Calculated()
    {
        $parents = array();

        $parent1 = new HouseholdMember();
        $parent1->isWorking = true;
        $parent1->workIncome = 20000;
        $parents[] = $parent1;

        $result = $this->_allowanceCalculator
            ->calculateEmploymentExpenseAllowance(EfcCalculationRole::Parent, MaritalStatus::SingleSeparatedDivorced, $parents);
        $this->assertEquals(4000, $result);
    }

    function testCalculateEmploymentExpenseAllowance_OneWorking_EqualsZero()
    {
        $parents = array();

        $parent1 = new HouseholdMember();
        $parent1->isWorking = false;
        $parent1->workIncome = 2000;
        $parents[] = $parent1;

		$parent2 = new HouseholdMember();
        $parent2->isWorking = true;
        $parent2->workIncome = 4000;
        $parents[] = $parent2;

        $result = $this->_allowanceCalculator
            ->calculateEmploymentExpenseAllowance(EfcCalculationRole::Parent, MaritalStatus::MarriedRemarried, $parents);
        $this->assertEquals(0, $result);
    }

    function testCalculateEmploymentExpenseAllowance_NoParents_EqualsZero()
    {
        $parents = array();
        $result = $this->_allowanceCalculator
            ->calculateEmploymentExpenseAllowance(EfcCalculationRole::Parent, MaritalStatus::MarriedRemarried, $parents);
        $this->assertEquals(0, $result);
    }

    function testCalculateEmploymentExpenseAllowance_NullParents_EqualsZero()
    {
        $result = $this->_allowanceCalculator
            ->calculateEmploymentExpenseAllowance(EfcCalculationRole::Parent, MaritalStatus::MarriedRemarried, null);
        $this->assertEquals(0, $result);
    }

    function testCalculateEmploymentExpenseAllowance_SingleIndependentStudentWithoutDep_Calculated()
    {
        $adults = array();

        $adult1 = new HouseholdMember();
        $adult1->isWorking = true;
        $adult1->workIncome = 2000;
        $adults[] = $adult1;

        $result = $this->_allowanceCalculator
            ->calculateEmploymentExpenseAllowance(EfcCalculationRole::IndependentStudentWithoutDependents, MaritalStatus::SingleSeparatedDivorced, $adults);
        $this->assertEquals(0, $result);
    }

    function testCalculateEmploymentExpenseAllowance_DependentStudent_EqualsZero()
    {
        $adults = array();

        $adult1 = new HouseholdMember();
        $adult1->isWorking = true;
        $adult1->workIncome = 2000;
        $adults[] = $adult1;

        $result = $this->_allowanceCalculator
            ->calculateEmploymentExpenseAllowance(EfcCalculationRole::DependentStudent, MaritalStatus::SingleSeparatedDivorced, $adults);
        $this->assertEquals(0, $result);
    }

    function testCalculateEmploymentExpenseAllowance_TooManyPeople_Calculated()
    {
        $adults = array();

        $adult1 = new HouseholdMember();
        $adult1->isWorking = true;
        $adult1->workIncome = 6000;
        $adults[] = $adult1;

        $adult2 = new HouseholdMember();
        $adult2->isWorking = true;
        $adult2->workIncome = 5000;
        $adults[] = $adult2;

        $adult3 = new HouseholdMember();
        $adult3->isWorking = true;
        $adult3->workIncome = 4000;
        $adults[] = $adult3;

        $adult4 = new HouseholdMember();
        $adult4->isWorking = true;
        $adult4->workIncome = 3000;
        $adults[] = $adult4;

        $result = $this->_allowanceCalculator
            ->calculateEmploymentExpenseAllowance(EfcCalculationRole::Parent, MaritalStatus::MarriedRemarried, $adults);
        $this->assertEquals(1050, $result);
    }

    function testCalculateEmploymentExpenseAllowance_NegativeValue_EqualsZero()
    {
        $parents = array();

        $parent1 = new HouseholdMember();
        $parent1->isWorking = true;
        $parent1->workIncome = -2000;
        $parents[] = $parent1;

		$parent2 = new HouseholdMember();
        $parent2->isWorking = true;
        $parent2->workIncome = -4000;
        $parents[] = $parent2;

        $result = $this->_allowanceCalculator
            ->calculateEmploymentExpenseAllowance(EfcCalculationRole::Parent, MaritalStatus::MarriedRemarried, $parents);
        $this->assertEquals(0, $result);
    }

    function testCalculateEmploymentExpenseAllowance_DecimalValue_Rounded()
    {
        $parents = array();

        $parent1 = new HouseholdMember();
        $parent1->isWorking = true;
        $parent1->workIncome = 2000.55;
        $parents[] = $parent1;

		$parent2 = new HouseholdMember();
        $parent2->isWorking = true;
        $parent2->workIncome = 4000.86;
        $parents[] = $parent2;

        $result = $this->_allowanceCalculator
            ->calculateEmploymentExpenseAllowance(EfcCalculationRole::Parent, MaritalStatus::MarriedRemarried, $parents);
        $this->assertEquals(700, $result);
    }

    function testCalculateEmploymentExpenseAllowance_BelowThreshold_Calculated()
    {
        $parents = array();

        $parent1 = new HouseholdMember();
        $parent1->isWorking = true;
        $parent1->workIncome = 10000;
        $parents[] = $parent1;

        $result = $this->_allowanceCalculator
            ->calculateEmploymentExpenseAllowance(EfcCalculationRole::Parent, MaritalStatus::MarriedRemarried, $parents);
        $this->assertEquals(3500, $result);
    }

    function testCalculateTotalAllowances_Parent_Calculated()
    {
        $parents = array();

        $parent1 = new HouseholdMember();
        $parent1->isWorking = true;
        $parent1->workIncome = 15000;
        $parents[] = $parent1;

		$parent2 = new HouseholdMember();
        $parent2->isWorking = true;
        $parent2->workIncome = 20000;
        $parents[] = $parent2;

        $result = $this->_allowanceCalculator->calculateTotalAllowances(
            EfcCalculationRole::Parent,
            MaritalStatus::MarriedRemarried,
            UnitedStatesStateOrTerritory::California,
            2,
            3,
            $parents,
            45000,
            3000);

        $this->assertEquals(33338, $result);
    }

    function testCalculateTotalAllowances_IndependentStudentWithoutDep_Calculated()
    {
        $adults = array();

        $adult1 = new HouseholdMember();
        $adult1->isWorking = true;
        $adult1->workIncome = 30000;
        $adults[] = $adult1;

        $result = $this->_allowanceCalculator->calculateTotalAllowances(
            EfcCalculationRole::IndependentStudentWithoutDependents,
            MaritalStatus::SingleSeparatedDivorced,
            UnitedStatesStateOrTerritory::California,
            1,
            1,
            $adults,
            35000,
            4000);

        $this->assertEquals(19035, $result);
    }

    function testCalculateTotalAllowances_IndependentStudentWithDep_Calculated()
    {
        $adults = array();

        $adult1 = new HouseholdMember();
        $adult1->isWorking = false;
        $adult1->workIncome = 0;
        $adults[] = $adult1;

        $adult2 = new HouseholdMember();
        $adult2->isWorking = true;
        $adult2->workIncome = 20000;
        $adults[] = $adult2;

        $result = $this->_allowanceCalculator->calculateTotalAllowances(
            EfcCalculationRole::IndependentStudentWithDependents,
            MaritalStatus::MarriedRemarried,
            UnitedStatesStateOrTerritory::California,
            1,
            2,
            $adults,
            25000,
            3000);

        $this->assertEquals(33220, $result);
    }

	function testCalculateTotalAllowances_DependentStudent_Calculated()
	{
        $adults = array();

        $adult1 = new HouseholdMember();
        $adult1->isWorking = true;
        $adult1->workIncome = 10000;
        $adults[] = $adult1;

		$result = $this->_allowanceCalculator->calculateTotalAllowances(
		    EfcCalculationRole::DependentStudent,
		    MaritalStatus::SingleSeparatedDivorced,
		    UnitedStatesStateOrTerritory::California,
		    1,
		    1,
		    $adults,
		    10000,
		    1000);

		$this->assertEquals(9205, $result);
	}
}
?>