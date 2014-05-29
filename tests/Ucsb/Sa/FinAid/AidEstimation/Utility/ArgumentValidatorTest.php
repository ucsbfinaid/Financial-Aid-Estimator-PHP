<?php
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\IncomeEarnedBy;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\MaritalStatus;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\UnitedStatesStateOrTerritory;
use Ucsb\Sa\FinAid\AidEstimation\Utility\ArgumentValidator;
use Ucsb\Sa\FinAid\AidEstimation\Utility\ValidationError;

class ArgumentValidatorTest extends PHPUnit_Framework_TestCase
{

    public function testValidateBoolean_ValidInput_ParsedValue()
    {
        $validator = new ArgumentValidator();
        $result = $validator->validateBoolean("true", "test", "Test");
        $this->assertEquals(true, $result);
    }


    public function testValidateBoolean_NullInput_ReturnsError()
    {
        $validator = new ArgumentValidator();
        $validator->validateBoolean(null, "test", "Test");
        $this->assertEquals(1, count($validator->errors));
    }


    public function testValidateBoolean_EmptyInput_ReturnsError()
    {
        $validator = new ArgumentValidator();
        $validator->validateBoolean(null, "test", "Test");
        $this->assertEquals(1, count($validator->errors));
    }


    public function testValidateBoolean_BadValue_ReturnsError()
    {
        $validator = new ArgumentValidator();
        $validator->validateBoolean("G", "test", "Test");
        $this->assertEquals(1, count($validator->errors));
    }


    /** @expectedException \Exception */
    public function testValidateBoolean_NullDisplayName_ThrowsException()
    {
        $validator = new ArgumentValidator();
        $validator->validateBoolean("true", null, "Test");
    }


    /** @expectedException \Exception */
    public function testValidateBoolean_EmptyDisplayName_ThrowsException()
    {
        $validator = new ArgumentValidator();
        $validator->validateBoolean("true", "", "Test");
    }


    /** @expectedException \Exception */
    public function testValidateBoolean_NullParamName_ThrowsException()
    {
        $validator = new ArgumentValidator();
        $validator->validateBoolean("true", "test", null);
    }


    /** @expectedException \Exception */
    public function testValidateBoolean_EmptyParamName_ThrowsException()
    {
        $validator = new ArgumentValidator();
        $validator->validateBoolean("true", "test", "");
    }


    public function testValidatePositiveMoneyValue_ValidInput_ParsedValue()
    {
        $validator = new ArgumentValidator();
        $result = $validator->validatePositiveMoneyValue("3", "test", "Test");
        $this->assertEquals(3, $result);
    }


    public function testValidatePositiveMoneyValue_NullInput_ReturnsError()
    {
        $validator = new ArgumentValidator();
        $validator->validatePositiveMoneyValue(null, "test", "Test");
        $this->assertEquals(1, count($validator->errors));
    }


    public function testValidatePositiveMoneyValue_EmptyInput_ReturnsError()
    {
        $validator = new ArgumentValidator();
        $validator->validatePositiveMoneyValue(null, "test", "Test");
        $this->assertEquals(1, count($validator->errors));
    }


    public function testValidatePositiveMoneyValue_BadValue_ReturnsError()
    {
        $validator = new ArgumentValidator();
        $validator->validatePositiveMoneyValue("G", "test", "Test");
        $this->assertEquals(1, count($validator->errors));
    }


    public function testValidatePositiveMoneyValue_OverMax_ReturnsError()
    {
        $validator = new ArgumentValidator();
        $validator->validatePositiveMoneyValue("9999999999", "test", "Test");
        $this->assertEquals(1, count($validator->errors));
    }


    public function testValidatePositiveMoneyValue_Negative_ReturnsError()
    {
        $validator = new ArgumentValidator();
        $validator->validatePositiveMoneyValue("-1", "test", "Test");
        $this->assertEquals(1, count($validator->errors));
    }


    /** @expectedException \Exception */
    public function testValidatePositiveMoneyValue_NullDisplayName_ThrowsException()
    {
        $validator = new ArgumentValidator();
        $validator->validatePositiveMoneyValue("3", null, "Test");
    }


    /** @expectedException \Exception */
    public function testValidatePositiveMoneyValue_EmptyDisplayName_ThrowsException()
    {
        $validator = new ArgumentValidator();
        $validator->validatePositiveMoneyValue("3", "", "Test");
    }


    /** @expectedException \Exception */
    public function testValidatePositiveMoneyValue_NullParamName_ThrowsException()
    {
        $validator = new ArgumentValidator();
        $validator->validatePositiveMoneyValue("3", "test", null);
    }


    /** @expectedException \Exception */
    public function testValidatePositiveMoneyValue_EmptyParamName_ThrowsException()
    {
        $validator = new ArgumentValidator();
        $validator->validatePositiveMoneyValue("3", "test", "");
    }


    public function testValidateMoneyValue_ValidInput_ParsedValue()
    {
        $validator = new ArgumentValidator();
        $result = $validator->validateMoneyValue("-3", "test", "Test");
        $this->assertEquals(-3, $result);
    }


    public function testValidateMoneyValue_NullInput_ReturnsError()
    {
        $validator = new ArgumentValidator();
        $validator->validateMoneyValue(null, "test", "Test");
        $this->assertEquals(1, count($validator->errors));
    }


    public function testValidateMoneyValue_EmptyInput_ReturnsError()
    {
        $validator = new ArgumentValidator();
        $validator->validateMoneyValue(null, "test", "Test");
        $this->assertEquals(1, count($validator->errors));
    }


    public function testValidateMoneyValue_BadValue_ReturnsError()
    {
        $validator = new ArgumentValidator();
        $validator->validateMoneyValue("G", "test", "Test");
        $this->assertEquals(1, count($validator->errors));
    }


    public function testValidateMoneyValue_OverMax_ReturnsError()
    {
        $validator = new ArgumentValidator();
        $validator->validateMoneyValue("9999999999", "test", "Test");
        $this->assertEquals(1, count($validator->errors));
    }


    public function testValidateMoneyValue_UnderMin_ReturnsError()
    {
        $validator = new ArgumentValidator();
        $validator->validateMoneyValue("-9999999999", "test", "Test");
        $this->assertEquals(1, count($validator->errors));
    }


    /** @expectedException \Exception */
    public function testValidateMoneyValue_NullDisplayName_ThrowsException()
    {
        $validator = new ArgumentValidator();
        $validator->validateMoneyValue("3", null, "Test");
    }


    /** @expectedException \Exception */
    public function testValidateMoneyValue_EmptyDisplayName_ThrowsException()
    {
        $validator = new ArgumentValidator();
        $validator->validateMoneyValue("3", "", "Test");
    }


    /** @expectedException \Exception */
    public function testValidateMoneyValue_NullParamName_ThrowsException()
    {
        $validator = new ArgumentValidator();
        $validator->validateMoneyValue("3", "test", null);
    }


    /** @expectedException \Exception */
    public function testValidateMoneyValue_EmptyParamName_ThrowsException()
    {
        $validator = new ArgumentValidator();
        $validator->validateMoneyValue("3", "test", "");
    }


    public function testValidateNonZeroInteger_ValidInput_ParsedValue()
    {
        $validator = new ArgumentValidator();
        $result = $validator->validateNonZeroInteger("3", "test", "Test");
        $this->assertEquals(3, $result);
    }


    public function testValidateNonZeroInteger_NullInput_ReturnsError()
    {
        $validator = new ArgumentValidator();
        $validator->validateNonZeroInteger(null, "test", "Test");
        $this->assertEquals(1, count($validator->errors));
    }


    public function testValidateNonZeroInteger_EmptyInput_ReturnsError()
    {
        $validator = new ArgumentValidator();
        $validator->validateNonZeroInteger(null, "test", "Test");
        $this->assertEquals(1, count($validator->errors));
    }


    public function testValidateNonZeroInteger_BadValue_ReturnsError()
    {
        $validator = new ArgumentValidator();
        $validator->validateNonZeroInteger("G", "test", "Test");
        $this->assertEquals(1, count($validator->errors));
    }


    public function testValidateNonZeroInteger_Zero_ReturnsError()
    {
        $validator = new ArgumentValidator();
        $validator->validateNonZeroInteger("0", "test", "Test");
        $this->assertEquals(1, count($validator->errors));
    }


    public function testValidateNonZeroInteger_Negative_ReturnsError()
    {
        $validator = new ArgumentValidator();
        $validator->validateNonZeroInteger("-99", "test", "Test");
        $this->assertEquals(1, count($validator->errors));
    }


    /** @expectedException \Exception */
    public function testValidateNonZeroInteger_NullDisplayName_ThrowsException()
    {
        $validator = new ArgumentValidator();
        $validator->validateNonZeroInteger("3", null, "Test");
    }


    /** @expectedException \Exception */
    public function testValidateNonZeroInteger_EmptyDisplayName_ThrowsException()
    {
        $validator = new ArgumentValidator();
        $validator->validateNonZeroInteger("3", "", "Test");
    }


    /** @expectedException \Exception */
    public function testValidateNonZeroInteger_NullParamName_ThrowsException()
    {
        $validator = new ArgumentValidator();
        $validator->validateNonZeroInteger("3", "test", null);
    }


    /** @expectedException \Exception */
    public function testValidateNonZeroInteger_EmptyParamName_ThrowsException()
    {
        $validator = new ArgumentValidator();
        $validator->validateNonZeroInteger("3", "test", "");
    }


    public function testValidateMaritalStatus_Single_ParsedValue()
    {
        $validator = new ArgumentValidator();
        $result = $validator->validateMaritalStatus("single", "test", "Test");
        $this->assertEquals(MaritalStatus::SingleSeparatedDivorced, $result);
    }


    public function testValidateMaritalStatus_Married_ParsedValue()
    {
        $validator = new ArgumentValidator();
        $result = $validator->validateMaritalStatus("married", "test", "Test");
        $this->assertEquals(MaritalStatus::MarriedRemarried, $result);
    }


    public function testValidateMaritalStatus_VariedCase_ParsedValue()
    {
        $validator = new ArgumentValidator();
        $result = $validator->validateMaritalStatus("mArRiEd", "test", "Test");
        $this->assertEquals(MaritalStatus::MarriedRemarried, $result);
    }


    public function testValidateMaritalStatus_NullInput_ReturnsError()
    {
        $validator = new ArgumentValidator();
        $validator->validateMaritalStatus(null, "test", "Test");
        $this->assertEquals(1, count($validator->errors));
    }


    public function testValidateMaritalStatus_EmptyInput_ReturnsError()
    {
        $validator = new ArgumentValidator();
        $validator->validateMaritalStatus(null, "test", "Test");
        $this->assertEquals(1, count($validator->errors));
    }


    public function testValidateMaritalStatus_BadValue_ReturnsError()
    {
        $validator = new ArgumentValidator();
        $validator->validateMaritalStatus("G", "test", "Test");
        $this->assertEquals(1, count($validator->errors));
    }


    /** @expectedException \Exception */
    public function testValidateMaritalStatus_NullDisplayName_ThrowsException()
    {
        $validator = new ArgumentValidator();
        $validator->validateMaritalStatus("3", null, "Test");
    }


    /** @expectedException \Exception */
    public function testValidateMaritalStatus_EmptyDisplayName_ThrowsException()
    {
        $validator = new ArgumentValidator();
        $validator->validateMaritalStatus("3", "", "Test");
    }


    /** @expectedException \Exception */
    public function testValidateMaritalStatus_NullParamName_ThrowsException()
    {
        $validator = new ArgumentValidator();
        $validator->validateMaritalStatus("3", "test", null);
    }


    /** @expectedException \Exception */
    public function testValidateMaritalStatus_EmptyParamName_ThrowsException()
    {
        $validator = new ArgumentValidator();
        $validator->validateMaritalStatus("3", "test", "");
    }


    public function testValidateUnitedStatesStateOrTerritory_State_ParsedValue()
    {
        $validator = new ArgumentValidator();
        $result = $validator->validateUnitedStatesStateOrTerritory("minnesota", "test", "Test");
        $this->assertEquals(UnitedStatesStateOrTerritory::Minnesota, $result);
    }


    public function testValidateUnitedStatesStateOrTerritory_VariedCase_ParsedValue()
    {
        $validator = new ArgumentValidator();
        $result = $validator->validateUnitedStatesStateOrTerritory("cAlIfOrNiA", "test", "Test");
        $this->assertEquals(UnitedStatesStateOrTerritory::California, $result);
    }


    public function testValidateUnitedStatesStateOrTerritory_NullInput_ReturnsError()
    {
        $validator = new ArgumentValidator();
        $validator->validateUnitedStatesStateOrTerritory(null, "test", "Test");
        $this->assertEquals(1, count($validator->errors));
    }


    public function testValidateUnitedStatesStateOrTerritory_EmptyInput_ReturnsError()
    {
        $validator = new ArgumentValidator();
        $validator->validateUnitedStatesStateOrTerritory(null, "test", "Test");
        $this->assertEquals(1, count($validator->errors));
    }


    public function testValidateUnitedStatesStateOrTerritory_BadValue_ReturnsError()
    {
        $validator = new ArgumentValidator();
        $validator->validateUnitedStatesStateOrTerritory("G", "test", "Test");
        $this->assertEquals(1, count($validator->errors));
    }


    /** @expectedException \Exception */
    public function testValidateUnitedStatesStateOrTerritory_NullDisplayName_ThrowsException()
    {
        $validator = new ArgumentValidator();
        $validator->validateUnitedStatesStateOrTerritory("3", null, "Test");
    }


    /** @expectedException \Exception */
    public function testValidateUnitedStatesStateOrTerritory_EmptyDisplayName_ThrowsException()
    {
        $validator = new ArgumentValidator();
        $validator->validateUnitedStatesStateOrTerritory("3", "", "Test");
    }


    /** @expectedException \Exception */
    public function testValidateUnitedStatesStateOrTerritory_NullParamName_ThrowsException()
    {
        $validator = new ArgumentValidator();
        $validator->validateUnitedStatesStateOrTerritory("3", "test", null);
    }


    /** @expectedException \Exception */
    public function testValidateUnitedStatesStateOrTerritory_EmptyParamName_ThrowsException()
    {
        $validator = new ArgumentValidator();
        $validator->validateUnitedStatesStateOrTerritory("3", "test", "");
    }


    public function testValidateIncomeEarnedBy_State_ParsedValue()
    {
        $validator = new ArgumentValidator();
        $result = $validator->validateIncomeEarnedBy("both", "test", "Test");
        $this->assertEquals(IncomeEarnedBy::Both, $result);
    }


    public function testValidateIncomeEarnedBy_VariedCase_ParsedValue()
    {
        $validator = new ArgumentValidator();
        $result = $validator->validateIncomeEarnedBy("oNe", "test", "Test");
        $this->assertEquals(IncomeEarnedBy::One, $result);
    }


    public function testValidateIncomeEarnedBy_NullInput_ReturnsError()
    {
        $validator = new ArgumentValidator();
        $validator->validateIncomeEarnedBy(null, "test", "Test");
        $this->assertEquals(1, count($validator->errors));
    }


    public function testValidateIncomeEarnedBy_EmptyInput_ReturnsError()
    {
        $validator = new ArgumentValidator();
        $validator->validateIncomeEarnedBy(null, "test", "Test");
        $this->assertEquals(1, count($validator->errors));
    }


    public function testValidateIncomeEarnedBy_BadValue_ReturnsError()
    {
        $validator = new ArgumentValidator();
        $validator->validateIncomeEarnedBy("G", "test", "Test");
        $this->assertEquals(1, count($validator->errors));
    }


    /** @expectedException \Exception */
    public function testValidateIncomeEarnedBy_NullDisplayName_ThrowsException()
    {
        $validator = new ArgumentValidator();
        $validator->validateIncomeEarnedBy("3", null, "Test");
    }


    /** @expectedException \Exception */
    public function testValidateIncomeEarnedBY_EmptyDisplayName_ThrowsException()
    {
        $validator = new ArgumentValidator();
        $validator->validateIncomeEarnedBy("3", "", "Test");
    }


    /** @expectedException \Exception */
    public function testValidateIncomeEarnedBy_NullParamName_ThrowsException()
    {
        $validator = new ArgumentValidator();
        $validator->validateIncomeEarnedBy("3", "test", null);
    }


    /** @expectedException \Exception */
    public function testValidateIncomeEarnedBy_EmptyParamName_ThrowsException()
    {
        $validator = new ArgumentValidator();
        $validator->validateIncomeEarnedBy("3", "test", "");
    }
}
?>