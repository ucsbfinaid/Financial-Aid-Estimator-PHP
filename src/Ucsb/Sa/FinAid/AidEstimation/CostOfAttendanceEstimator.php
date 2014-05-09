<?php
namespace Ucsb\Sa\FinAid\AidEstimation;

/**
 * A calculator for estimating the Cost of Attendance
 * @package Ucsb\Sa\FinAid\AidEstimation
 */
class CostOfAttendanceEstimator
{
    private $_constants;

	/**
	 * Constructs a new Cost of Attendance Estimator
	 * @param string[] $constants An array of unique string keys associated with Cost of Attendance values
	 */
	public function __construct($constants)
	{
		$this->_constants = $constants;
	}

	/**
	 * Gets the cost of attendance associated with the provided education level and
	 * housing option
	 * @param EducationLevel Education level
	 * @param HousingOption Housing option
	 * @return CostOfAttendance
	 */
    public function getCostOfAttendance($educationLevel, $housingOption)
    {
    	$key = self::getCostOfAttendanceKey($educationLevel, $housingOption);
    	return array_key_exists($key, $this->_constants)
    		? $this->_constants[$key]
    		: null;
    }

	/**
	 * Generates a key to be used for storing Cost of Attendance values
	 * @param EducationLevel Education level
	 * @param HousingOption Housing option
	 * @return CostOfAttendance
	 */
    public static function getCostOfAttendanceKey($educationLevel, $housingOption)
    {
    	return $educationLevel . "" . $housingOption;
    }
}
?>