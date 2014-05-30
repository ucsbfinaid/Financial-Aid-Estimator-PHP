<?php
namespace Ucsb\Sa\FinAid\AidEstimation\Utility;

use Ucsb\Sa\FinAid\AidEstimation\CostOfAttendance;
use Ucsb\Sa\FinAid\AidEstimation\CostOfAttendanceEstimator;
use Ucsb\Sa\FinAid\AidEstimation\CostOfAttendanceItem;
use Ucsb\Sa\FinAid\AidEstimation\EducationLevel;
use Ucsb\Sa\FinAid\AidEstimation\HousingOption;

/**
 * @package Ucsb\Sa\FinAid\AidEstimation\Utility
 */
class CostOfAttendanceEstimatorFactory
{
    public static $constantsPath = '';

    public static function getCostOfAttendanceEstimator($key)
    {
        // Construct constants object
        $constantType = 'AidEstimationConstants' . $key;

        require_once(self::$constantsPath . $constantType . '.php');
        $constants = new $constantType;

        $coaList = array();

        // Loop through the Education Levels
        foreach($constants->costOfAttendanceValues as $educationLevel => $housingCoaValues)
        {
        	// Parse Education Level
        	if($educationLevel == "graduate")
        	{
        		$currEducationLevel = EducationLevel::Graduate;
        	}
        	elseif ($educationLevel == "undergraduate")
        	{
        		$currEducationLevel = EducationLevel::Undergraduate;
        	}
        	else
        	{
        		// Invalid education level
        		continue;
        	}

        	// Loop through the Housing Options
        	foreach($housingCoaValues as $housingOption => $coaItems)
        	{
        		// Parse Housing Option
        		if($housingOption == "oncampus")
        		{
        			$currHousingOption = HousingOption::OnCampus;
        		}
        		elseif ($housingOption == "offcampus")
        		{
        			$currHousingOption = HousingOption::OffCampus;
        		}
        		elseif ($housingOption == "commuter")
        		{
        			$currHousingOption = HousingOption::Commuter;
        		}
        		else
        		{
        			// Invalid housing option
        			continue;
        		}

        		$coa = new CostOfAttendance();

        		// Loop through the Cost of Attendance Items
        		foreach ($coaItems as $name => $info)
        		{
        			$coaItem = new CostOfAttendanceItem();
        			$coaItem->name = $name;
        			$coaItem->value = $info['value'];
        			$coaItem->description = $info['description'];

        			$coa->items[] = $coaItem;
        		}

        		$key = CostOfAttendanceEstimator::getCostOfAttendanceKey($currEducationLevel, $currHousingOption);
        		$coaList[$key] = $coa;
        	}
        }

        return new CostOfAttendanceEstimator($coaList);
    }
} 

?>