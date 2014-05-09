<?php
namespace Ucsb\Sa\FinAid\AidEstimation;

class CostOfAttendance
{
    public $outOfStateFees;

    /**
     * The list of items that constitute the Cost of Attendance.
     * This does not include Out of State Fees
     * @var CostOfAttendanceItem[]
     */
    public $items = array();

    /**
     * Calculates the total cost of attendance (not including out of state fees)
     * @return float
     */
    public function getTotal()
    {
        $total = 0;

    	foreach ($this->items as $item)
    	{
    		$total += $item->value;
    	}

    	return $total;
    }
}
?>