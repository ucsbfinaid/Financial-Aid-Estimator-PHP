<?php
use Ucsb\Sa\FinAid\AidEstimation\CostOfAttendance;
use Ucsb\Sa\FinAid\AidEstimation\CostOfAttendanceItem;

class CostOfAttendanceTest extends PHPUnit_Framework_TestCase
{
	public function testGetTotal_NoItems_EqualsZero()
	{
		$coa = new CostOfAttendance();
		$this->assertEquals(0, $coa->getTotal());
	}

	public function testGetTotal_Items_Calculated()
	{
        $coa = new CostOfAttendance();

        $coaItem1 = new CostOfAttendanceItem();
        $coaItem1->value = 100;
        $coa->items[] = $coaItem1;

		$coaItem2 = new CostOfAttendanceItem();
        $coaItem2->value = 300;
        $coa->items[] = $coaItem2;

        $this->assertEquals(400, $coa->getTotal());
	}
}
?>