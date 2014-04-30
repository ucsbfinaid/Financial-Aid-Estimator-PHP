<?php
class EfcMathHelperTest extends PHPUnit_Framework_TestCase
{
	public function testRound_negative_sameValue()
	{
		$result = Ucsb\Sa\FinAid\AidEstimation\Utility\EfcMathHelper::round(-10);
		$this->assertEquals(-10, $result);
	}

	public function testRound_positiveInt_sameValue()
	{
		$result = Ucsb\Sa\FinAid\AidEstimation\Utility\EfcMathHelper::round(10);
		$this->assertEquals(10, $result);
	}

	public function testRound_positiveDecimal_rounded()
	{
		$result = Ucsb\Sa\FinAid\AidEstimation\Utility\EfcMathHelper::round(10.3);
		$this->assertEquals(10, $result);
	}

	public function testRound_negativeDecimal_rounded()
	{
		$result = Ucsb\Sa\FinAid\AidEstimation\Utility\EfcMathHelper::round(-10.3);
		$this->assertEquals(-10, $result);
	}

	public function testRound_midDecimal_roundedUp()
	{
		$result = Ucsb\Sa\FinAid\AidEstimation\Utility\EfcMathHelper::round(10.5);
		$this->assertEquals(11, $result);
	}

	public function testRound_midNegativeDecimal_roundedDown()
	{
		$result = Ucsb\Sa\FinAid\AidEstimation\Utility\EfcMathHelper::round(-10.5);
		$this->assertEquals(-11, $result);
	}

	public function testRoundPositive_negative_zero()
	{
		$result = Ucsb\Sa\FinAid\AidEstimation\Utility\EfcMathHelper::roundPositive(-10);
		$this->assertEquals(0, $result);
	}

	public function testRoundPositive_positiveInt_sameValue()
	{
		$result = Ucsb\Sa\FinAid\AidEstimation\Utility\EfcMathHelper::roundPositive(10);
		$this->assertEquals(10, $result);
	}

	public function testRoundPositive_decimal_rounded()
	{
		$result = Ucsb\Sa\FinAid\AidEstimation\Utility\EfcMathHelper::roundPositive(10.3);
		$this->assertEquals(10, $result);
	}

	public function testRoundPositive_midDecimal_roundedUp()
	{
		$result = Ucsb\Sa\FinAid\AidEstimation\Utility\EfcMathHelper::roundPositive(10.5);
		$this->assertEquals(11, $result);
	}
}
?>