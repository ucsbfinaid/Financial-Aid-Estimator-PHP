<?php
namespace Ucsb\Sa\FinAid\AidEstimation;

/**
 * Represents a ranged Financial Aid award. For example: "$500 - $700".
 * Negative amounts are not allowed within a range; negative amounts will be
 * set to zero
 * @package Ucsb\Sa\FinAid\AidEstimation
 */
class AwardRange
{
    public $maximum;

    public $minimum;

    /**
     * Creates a range using the provided target value and buffer values. For example,
     * if the "value" is "500", the "lowerBuffer" is "300", and the "upperBuffer" is
     * "100", the resulting range will be "$200 - $600".
     *
     * If, after the buffer calculation, either of the range values are negative OR either
     * of the range values is less than the "minimumAwardValue", the values will be set to zero.
     * By default, the "minimumAwardValue" is set to zero.
     * 
     * If this function is only called with a "value" and "lowerBuffer", "upperBuffer" will
     * be set equal to "lowerBuffer".
     */
    public static function getRangeFromValue($value, $lowerBuffer, $upperBuffer = -1, $minimumAwardValue = 0)
    {
        $formattedLowerBuffer = 0;
        $formattedUpperBuffer = 0;

        if(func_num_args() == 2)
        {
            // If only a value and lower buffer have been provided, use the lower buffer as the upper buffer
            $formattedUpperBuffer = $formattedLowerBuffer = $lowerBuffer;
        }
        else
        {
            $formattedLowerBuffer = $lowerBuffer;
            $formattedUpperBuffer = $upperBuffer;
        }

        if ($formattedLowerBuffer < 0 || $formattedUpperBuffer < 0)
        {
            throw new \Exception("Buffer values can not be negative");
        }

        return new AwardRange($value - $formattedLowerBuffer, $value + $formattedUpperBuffer, $minimumAwardValue);
    }

    /**
     * Constructs a new Award Range with the specificed minimum, maximum, and minimum award values.
     * By default, the minimum award value is set to zero.
     *
     */
    public function __construct($minimum, $maximum, $minimumAwardValue = 0)
    {
        if ($minimumAwardValue < 0)
        {
            throw new \Exception("Minimum award value can not be less than zero");
        }

        if ($minimum > $maximum)
        {
            throw new \Exception("Minimum range value can not be greater than maximum range value");
        }

        $this->minimum = ($minimum <= 0 || $minimum < $minimumAwardValue) ? 0 : $minimum;
        $this->maximum = ($maximum <= 0 || $maximum < $minimumAwardValue) ? 0 : $maximum;
    }

    /**
     * Displays the range in the following format: "${Minimum} - ${Maximum}". If the two amounts
     * are equal, only a single amount displays
     *
     */
    public function __toString()
    {
        $minOutput = $this->getCurrencyString($this->minimum);
        $maxOutput = $this->getCurrencyString($this->maximum);

        return ($minOutput == $maxOutput)
            ? $minOutput
            : sprintf("%s - %s", $minOutput, $maxOutput);
    }

    private function getCurrencyString($value)
    {
        // Display: $1,234.56
        return '$' . number_format($value, 2, '.', ',');
    }
}
?>