<?php
namespace Ucsb\Sa\FinAid\AidEstimation\Utility;

/**
 * Utility class for common math functions
 * @package Ucsb\Sa\FinAid\AidEstimation\Utility
 */
class EfcMathHelper
{
    /**
     * Rounds a value appropriately for use in EFC calculations. If value is less than zero, zero will be returned
     * @param float $value Value to round
     * @return float
     */
    public static function roundPositive($value)
    {
        if($value < 0)
        {
            return 0;
        }

        return round($value, 0, PHP_ROUND_HALF_UP);
    }
} 