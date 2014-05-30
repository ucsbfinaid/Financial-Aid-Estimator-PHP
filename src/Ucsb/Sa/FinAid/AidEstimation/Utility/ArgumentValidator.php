<?php
namespace Ucsb\Sa\FinAid\AidEstimation\Utility;

use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\IncomeEarnedBy;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\MaritalStatus;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\UnitedStatesStateOrTerritory;

/**
 * @package Ucsb\Sa\FinAid\AidEstimation\Utility
 */
class ArgumentValidator
{
    public $errors;

    const MaxMoneyValue = 999999999;
    const MinMoneyValue = -999999999;

    public function __construct()
    {
        $this->errors = array();
    }

    /**
     * Attempts to parse the input into a boolean. If the parsing fails, a ValidationError is
     * generated (using the provided parameter and message) and added to the validator's list of errors
     * @param $input Value to parse
     * @param $inputDisplayName Display name for the value being parsed
     * @param $inputParameterName Parameter name (identifiable key) for the value being parsed
     * @return boolean
     */
    public function validateBoolean($input, $inputDisplayName, $inputParameterName)
    {
        $this->validateInputInfo($inputDisplayName, $inputParameterName);

        // Provided?
        if ($input === null)
        {
            $this->errors[] = $this->getNoValueError($inputDisplayName, $inputParameterName);
            return false; // Stop validation
        }

        // Parsing
		$value = filter_var($input, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        if ($value === null)
        {
            $this->errors[] = $this->getConversionError($inputDisplayName, $inputParameterName);
            return false;
        }

        return $value;
    }

    /**
     * Attempts to parse the input into a double value that lies within the maximum and minimum range
     * (0-999999999). If the parsing fails, a ValidationError is generated (using the provided parameter and message)
     * and added to the validator's list of $this->errors
     * @param $input Value to parse
     * @param $inputDisplayName Display name for the value being parsed
     * @param $inputParameterName Parameter name (identifiable key) for the value being parsed
     * @return float
     */
    public function validatePositiveMoneyValue($input, $inputDisplayName, $inputParameterName)
    {
        $this->validateInputInfo($inputDisplayName, $inputParameterName);

        // Provided?
        if ($input === null || trim($input) === '')
        {
            $this->errors[] = $this->getNoValueError($inputDisplayName, $inputParameterName);
            return 0; // Stop validation
        }

        // Parsing
		$value = filter_var($input, FILTER_VALIDATE_FLOAT, FILTER_NULL_ON_FAILURE);

        if ($value === null)
        {
            $this->errors[] = $this->getConversionError($inputDisplayName, $inputParameterName);
            return 0; // Stop validation
        }

        // Maximum Range
        if ($value >= self::MaxMoneyValue)
        {
            $this->errors[] = $this->getMoneyMaximumError($inputDisplayName, $inputParameterName);
            return 0; // Stop validation
        }

        // Minimum Range
        if ($value < 0)
        {
            $this->errors[] = $this->getPositiveError($inputDisplayName, $inputParameterName);
            return 0; // Stop validation
        }

        return $value;
    }

	/**
     * Attempts to parse the input into a double value that lies within the maximum and minimum range
     * (-999999999-999999999). If the parsing fails, a ValidationError is
     * generated (using the provided parameter and message) and added to the validator's list of errors
     * @param $input Value to parse
     * @param $inputDisplayName Display name for the value being parsed
     * @param $inputParameterName Parameter name (identifiable key) for the value being parsed
     * @return float
     */
    public function ValidateMoneyValue($input, $inputDisplayName, $inputParameterName)
    {
        $this->validateInputInfo($inputDisplayName, $inputParameterName);

        // Provided?
        if ($input === null || trim($input) === '')
        {
            $this->errors[] = $this->getNoValueError($inputDisplayName, $inputParameterName);
            return 0; // Stop validation
        }

        // Parsing
		$value = filter_var($input, FILTER_VALIDATE_FLOAT, FILTER_NULL_ON_FAILURE);

        if ($value === null)
        {
            $this->errors[] = $this->getConversionError($inputDisplayName, $inputParameterName);
            return 0; // Stop validation
        }

        // Maximum Range
        if ($value >= self::MaxMoneyValue)
        {
            $this->errors[] = $this->getMoneyMaximumError($inputDisplayName, $inputParameterName);
            return 0; // Stop validation
        }

        // Minimum Range
        if ($value <= self::MinMoneyValue)
        {
            $this->errors[] = $this->getMoneyMinimumError($inputDisplayName, $inputParameterName);
            return 0; // Stop validation
        }

        return $value;
    }

	/**
     * Attempts to parse the input into a positive integer value (greater than 0).
     * If the parsing fails, a ValidationError is generated (using the provided parameter and
     * message) and added to the validator's list of errors
     * @param $input Value to parse
     * @param $inputDisplayName Display name for the value being parsed
     * @param $inputParameterName Parameter name (identifiable key) for the value being parsed
     * @return int
     */
    public function ValidateNonZeroInteger($input, $inputDisplayName, $inputParameterName)
    {
        $this->validateInputInfo($inputDisplayName, $inputParameterName);

        // Provided?
        if ($input === null || trim($input) === '')
        {
            $this->errors[] = $this->getNoValueError($inputDisplayName, $inputParameterName);
            return 0; // Stop validation
        }

        // Parsing
		$value = filter_var($input, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);

        if ($value === null)
        {
            $this->errors[] = $this->getConversionError($inputDisplayName, $inputParameterName);
            return 0; // Stop validation
        }

        if ($value <= 0)
        {
            $this->errors[] = $this->getNonZeroError($inputDisplayName, $inputParameterName);
            return 0; // Stop validation
        }

        return $value;
    }

	/**
     * Attempts to parse the input into a MaritalStatus enumeration value.
     * If the parsing fails, a ValidationError is generated (using the provided parameter
     * and message) and added to the validator's list of $this->errors
     * @param $input Value to parse
     * @param $inputDisplayName Display name for the value being parsed
     * @param $inputParameterName Parameter name (identifiable key) for the value being parsed
     * @return MaritalStatus
     */
    public function validateMaritalStatus($input, $inputDisplayName, $inputParameterName)
    {
        $this->validateInputInfo($inputDisplayName, $inputParameterName);

        // Provided?
        if ($input === null || trim($input) === '')
        {
            $this->errors[] = $this->getNoValueError($inputDisplayName, $inputParameterName);
            return MaritalStatus::None; // Stop validation
        }

        // Parsing
        $formattedInput = strtolower($input);

        switch($formattedInput)
        {
        	case "single":
        		return MaritalStatus::SingleSeparatedDivorced;

        	case "married":
        		return  MaritalStatus::MarriedRemarried;

        	default:
	            $this->errors[] = $this->getConversionError($inputDisplayName, $inputParameterName);
	            return MaritalStatus::None; // Stop validation
        }
    }

	/**
     * Attempts to parse the input into a <see cref="UnitedStatesStateOrTerritory"/> enumeration value.
     * If the parsing fails, a ValidationError is generated (using the provided parameter
     * and message) and added to the validator's list of $this->errors
     * @param $input Value to parse
     * @param $inputDisplayName Display name for the value being parsed
     * @param $inputParameterName Parameter name (identifiable key) for the value being parsed
     * @return UnitedStatesStateOrTerritory
     */
    public function validateUnitedStatesStateOrTerritory($input, $inputDisplayName, $inputParameterName)
    {
        $this->validateInputInfo($inputDisplayName, $inputParameterName);

        // Provided?
        if ($input === null || trim($input) === '')
        {
            $this->errors[] = $this->getNoValueError($inputDisplayName, $inputParameterName);
            return UnitedStatesStateOrTerritory::Other;
        }

        // Parsing
		$formattedInput = strtolower($input);

        switch($formattedInput)
        {
        	case "other":
        		return UnitedStatesStateOrTerritory::Other;

        	case "alabama":
        		return UnitedStatesStateOrTerritory::Alabama;

       		case "alaska":
        		return UnitedStatesStateOrTerritory::Alaska;

       		case "americansamoa":
        		return UnitedStatesStateOrTerritory::AmericanSamoa;

       		case "arizona":
        		return UnitedStatesStateOrTerritory::Arizona;

       		case "arkansas":
        		return UnitedStatesStateOrTerritory::Arkansas;

        	case "california":
        		return UnitedStatesStateOrTerritory::California;

        	case "canadaandcanadianprovinces":
        		return UnitedStatesStateOrTerritory::CanadaAndCanadianProvinces;

        	case "colorado":
        		return UnitedStatesStateOrTerritory::Colorado;

        	case "connecticut":
        		return UnitedStatesStateOrTerritory::Connecticut;

        	case "delaware":
        		return UnitedStatesStateOrTerritory::Delaware;

        	case "districtofcolumbia":
        		return UnitedStatesStateOrTerritory::DistrictOfColumbia;

        	case "federatedstatesofmicronesia":
        		return UnitedStatesStateOrTerritory::FederatedStatesOfMicronesia;

        	case "florida":
        		return UnitedStatesStateOrTerritory::Florida;

        	case "georgia":
        		return UnitedStatesStateOrTerritory::Georgia;

        	case "guam":
        		return UnitedStatesStateOrTerritory::Guam;

        	case "hawaii":
        		return UnitedStatesStateOrTerritory::Hawaii;

        	case "idaho":
        		return UnitedStatesStateOrTerritory::Idaho;

        	case "illinois":
        		return UnitedStatesStateOrTerritory::Illinois;

        	case "indiana":
        		return UnitedStatesStateOrTerritory::Indiana;

        	case "iowa":
        		return UnitedStatesStateOrTerritory::Iowa;

        	case "kansas":
        		return UnitedStatesStateOrTerritory::Kansas;

        	case "kentucky":
        		return UnitedStatesStateOrTerritory::Kentucky;

        	case "louisiana":
        		return UnitedStatesStateOrTerritory::Louisiana;

        	case "maine":
        		return UnitedStatesStateOrTerritory::Maine;

        	case "marshallislands":
        		return UnitedStatesStateOrTerritory::MarshallIslands;

        	case "maryland":
        		return UnitedStatesStateOrTerritory::Maryland;

        	case "massachusetts":
        		return UnitedStatesStateOrTerritory::Massachusetts;

        	case "mexico":
        		return UnitedStatesStateOrTerritory::Mexico;

        	case "michigan":
        		return UnitedStatesStateOrTerritory::Michigan;

        	case "minnesota":
        		return UnitedStatesStateOrTerritory::Minnesota;

        	case "mississippi":
        		return UnitedStatesStateOrTerritory::Mississippi;

        	case "missouri":
        		return UnitedStatesStateOrTerritory::Missouri;

        	case "montana":
        		return UnitedStatesStateOrTerritory::Montana;

        	case "nebraska":
        		return UnitedStatesStateOrTerritory::Nebraska;

        	case "nevada":
        		return UnitedStatesStateOrTerritory::Nevada;

        	case "newhampshire":
        		return UnitedStatesStateOrTerritory::NewHampshire;

        	case "newjersey":
        		return UnitedStatesStateOrTerritory::NewJersey;

        	case "newmexico":
        		return UnitedStatesStateOrTerritory::NewMexico;

        	case "newyork":
        		return UnitedStatesStateOrTerritory::NewYork;

        	case "northcarolina":
        		return UnitedStatesStateOrTerritory::NorthCarolina;

        	case "northdakota":
        		return UnitedStatesStateOrTerritory::NorthDakota;

        	case "northernmarianaislands":
        		return UnitedStatesStateOrTerritory::NorthernMarianaIslands;

        	case "ohio":
        		return UnitedStatesStateOrTerritory::Ohio;

        	case "oklahoma":
        		return UnitedStatesStateOrTerritory::Oklahoma;

        	case "oregon":
        		return UnitedStatesStateOrTerritory::Oregon;

        	case "palau":
        		return UnitedStatesStateOrTerritory::Palau;

        	case "pennsylvania":
        		return UnitedStatesStateOrTerritory::Pennsylvania;

        	case "puertorico":
        		return UnitedStatesStateOrTerritory::PuertoRico;

        	case "rhodeisland":
        		return UnitedStatesStateOrTerritory::RhodeIsland;

        	case "southcarolina":
        		return UnitedStatesStateOrTerritory::SouthCarolina;

        	case "southdakota":
        		return UnitedStatesStateOrTerritory::SouthDakota;

        	case "tennessee":
        		return UnitedStatesStateOrTerritory::Tennessee;

        	case "texas":
        		return UnitedStatesStateOrTerritory::Texas;

        	case "utah":
        		return UnitedStatesStateOrTerritory::Utah;

        	case "vermont":
        		return UnitedStatesStateOrTerritory::Vermont;

        	case "virginislands":
        		return UnitedStatesStateOrTerritory::VirginIslands;

        	case "virginia":
        		return UnitedStatesStateOrTerritory::Virginia;

        	case "washington":
        		return UnitedStatesStateOrTerritory::Washington;

        	case "westvirginia":
        		return UnitedStatesStateOrTerritory::WestVirginia;

        	case "wisconsin":
        		return UnitedStatesStateOrTerritory::Wisconsin;

        	case "wyoming":
        		return UnitedStatesStateOrTerritory::Wyoming;

        	default:
	            $this->errors[] = $this->getConversionError($inputDisplayName, $inputParameterName);
	            return UnitedStatesStateOrTerritory::Other; // Stop validation
        }
    }

	/**
     * Attempts to parse the input into an IncomeEarnedBy enumeration value.
     * If the parsing fails, a ValidationError is generated (using the provided parameter
     * and message) and added to the validator's list of $this->errors
     * @param $input Value to parse
     * @param $inputDisplayName Display name for the value being parsed
     * @param $inputParameterName Parameter name (identifiable key) for the value being parsed
     * @return IncomeEarnedBy
     */
    public function validateIncomeEarnedBy($input, $inputDisplayName, $inputParameterName)
    {
        $this->validateInputInfo($inputDisplayName, $inputParameterName);

        // Provided?
        if ($input === null || trim($input) === '')
        {
            $this->errors[] = $this->getNoValueError($inputDisplayName, $inputParameterName);
            return IncomeEarnedBy::None;
        }

        // Parsing
		$formattedInput = strtolower($input);

        switch($formattedInput)
        {
        	case "one":
        		return IncomeEarnedBy::One;

        	case "both":
        		return IncomeEarnedBy::Both;

        	case "none":
        		return IncomeEarnedBy::None;

        	default:
	            $this->errors[] = $this->getConversionError($inputDisplayName, $inputParameterName);
	            return IncomeEarnedBy::None; // Stop validation
        }
    }

    private function getNoValueError($inputDisplayName, $inputParameterName)
    {
        return $this->getError("No value provided for %s", $inputDisplayName, $inputParameterName);
    }

    private function getConversionError($inputDisplayName, $inputParameterName)
    {
        return $this->getError("Invalid value for %s", $inputDisplayName, $inputParameterName);
    }

    private function getMoneyMaximumError($inputDisplayName, $inputParameterName)
    {
        return $this->getError("%s must be less than $999,999,999.00", $inputDisplayName, $inputParameterName);
    }

    private function getMoneyMinimumError($inputDisplayName, $inputParameterName)
    {
        return $this->getError("%s must be more than -$999,999,999.00", $inputDisplayName, $inputParameterName);
    }

    private function getPositiveError($inputDisplayName, $inputParameterName)
    {
        return $this->getError("%s must be a positive number", $inputDisplayName, $inputParameterName);
    }

    private function getNonZeroError($inputDisplayName, $inputParameterName)
    {
        return $this->getError("%s must be greater than zero", $inputDisplayName, $inputParameterName);
    }

    private function getError($errorMessage, $inputDisplayName, $inputParameterName)
    {
        if ($errorMessage === null || trim($errorMessage) === '')
        {
            throw new \Exception("No error message provided");
        }

        $message = sprintf($errorMessage, $inputDisplayName);
        $error = new ValidationError($inputParameterName, $message);
        return $error;
    }

    private function validateInputInfo($inputDisplayName, $inputParameterName)
    {
        if ($inputDisplayName === null || trim($inputDisplayName) === '')
        {
            throw new \Exception("No input display name provided");
        }

        if ($inputParameterName === null || trim($inputParameterName) === '')
        {
            throw new \Exception("No input parameter name provided");
        }
    }
}
?>