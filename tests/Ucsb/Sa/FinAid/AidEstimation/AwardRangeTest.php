<?php
use Ucsb\Sa\FinAid\AidEstimation\AwardRange;

class AwardRangeTest extends PHPUnit_Framework_TestCase
{
	public function testConstructor_ValidValues_Constructed()
    {
        $range = new AwardRange(500, 1000);
        $this->assertEquals(500, $range->minimum);
        $this->assertEquals(1000, $range->maximum);
    }

    public function testConstructor_NegativeNumber_EqualsZero()
    {
        $range = new AwardRange(-1000, 100);
        $this->assertEquals(0, $range->minimum);
        $this->assertEquals(100, $range->maximum);
    }

    /**
     * @expectedException \Exception
     */
    public function testConstructor_MinimumGreaterThanMaximum_ThrowsException()
    {
        $range = new AwardRange(500, 0);
    }

    public function testToString_DifferentValues_OutputsRangeString()
    {
        $range = new AwardRange(500, 600);
        $this->assertEquals("$500.00 - $600.00", (string) $range);
    }

    public function testToString_EqualValues_OutputsSingleValueString()
    {
        $range = new AwardRange(500, 500);
        $this->assertEquals("$500.00", (string) $range);
    }

    public function testGetRangeFromValue_SingleValidBuffer_CreatesRange()
    {
        $range = AwardRange::getRangeFromValue(500, 100);
        $this->assertEquals(400, $range->minimum);
        $this->assertEquals(600, $range->maximum);
    }

    public function testGetRangeFromValue_MultipleValidBuffers_CreatesRange()
    {
        $range = AwardRange::getRangeFromValue(500, 50, 200);
        $this->assertEquals(450, $range->minimum);
        $this->assertEquals(700, $range->maximum);
    }

    /**
     * @expectedException \Exception
     */
    public function testGetRangeFromValue_FirstNegativeBufferValue_ThrowsException()
    {
        AwardRange::getRangeFromValue(400, -100, 500);
    }

    /**
     * @expectedException \Exception
     */
    public function testGetRangeFromValue_FirstSecondBufferValue_ThrowsException()
    {
        AwardRange::getRangeFromValue(400, 100, -500);
    }

    /**
     * @expectedException \Exception
     */
    public function testGetRangeFromValue_NegativeMinAwardValue_ThrowsException()
    {
        AwardRange::getRangeFromValue(400, 100, 100, -100);
    }

    public function testGetRangeFromValue_MinimumLessThanMinAwardValue_MinimumEqualsZero()
    {
        $range = AwardRange::getRangeFromValue(500, 100, 100, 500);
        $this->assertEquals(0, $range->minimum);
        $this->assertEquals(600, $range->maximum);
    }

    public function testGetRangeFromValue_MaximumLessThanMinAwardValue_BothEqualZero()
    {
        $range = AwardRange::getRangeFromValue(500, 100, 100, 700);
        $this->assertEquals(0, $range->minimum);
        $this->assertEquals(0, $range->maximum);
    }
}
?>