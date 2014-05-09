<?php
use Ucsb\Sa\FinAid\AidEstimation\CostOfAttendance;
use Ucsb\Sa\FinAid\AidEstimation\CostOfAttendanceConstants;
use Ucsb\Sa\FinAid\AidEstimation\CostOfAttendanceEstimator;
use Ucsb\Sa\FinAid\AidEstimation\CostOfAttendanceItem;
use Ucsb\Sa\FinAid\AidEstimation\EducationLevel;
use Ucsb\Sa\FinAid\AidEstimation\HousingOption;

class CostOfAttendanceEstimatorTest extends PHPUnit_Framework_TestCase
{
	public function testGetCostOfAttendance_NoItems_ReturnsNull()
	{
		$constants = array();
	    $estimator = new CostOfAttendanceEstimator($constants);

	    $coa = $estimator->getCostOfAttendance(EducationLevel::Graduate, HousingOption::OffCampus);
	    $this->assertNull($coa);
	}
	public function testGetCostOfAttendance_HasItems_ReturnsItem()
	{
	    $key = CostOfAttendanceEstimator::getCostOfAttendanceKey(EducationLevel::Graduate, HousingOption::OffCampus);

	    $coa = new CostOfAttendance();

	    $coaItem = new CostOfAttendanceItem();
	    $coaItem->value = 100;
	    $coa->items[] = $coaItem;

		$constants = array();
		$constants[$key] = $coa;

	    $estimator = new CostOfAttendanceEstimator($constants);

	    $testCoa = $estimator->getCostOfAttendance(EducationLevel::Graduate, HousingOption::OffCampus);
	    $this->assertEquals(100, $coa->items[0]->value);
	}
}
?>