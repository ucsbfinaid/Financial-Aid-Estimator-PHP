<?php
namespace Ucsb\Sa\FinAid\AidEstimation\Utility;

use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\AaiContributionCalculator;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\AllowanceCalculator;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\AssetContributionCalculator;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\EfcCalculator;
use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\IncomeCalculator;

/**
 * @package Ucsb\Sa\FinAid\AidEstimation\Utility
 */
class EfcCalculatorFactory
{
    public static $constantsPath = '';

    public static function getEfcCalculator($key)
    {
        // Construct constants object
        $constantType = 'EfcCalculationConstants' . $key;

        require_once(self::$constantsPath . $constantType . '.php');
        $constants = new $constantType;

        $incomeCalculator = new IncomeCalculator($constants);
        $allowanceCalculator = new AllowanceCalculator($constants);
        $assetContributionCalculator = new AssetContributionCalculator($constants);
        $aaiContributionCalculator = new AaiContributionCalculator($constants);

        return new EfcCalculator(
            $constants, $incomeCalculator, $allowanceCalculator,
            $assetContributionCalculator, $aaiContributionCalculator);
    }
} 