<?php
namespace Ucsb\Sa\FinAid\AidEstimation\EfcCalculation;

use Ucsb\Sa\FinAid\AidEstimation\EfcCalculation\EfcCalculationRole;
use Ucsb\Sa\FinAid\AidEstimation\Utility\EfcMathHelper;

/**
 * Contribution from Adjusted Available Income (AAI) calculator
 * @package Ucsb\Sa\FinAid\AidEstimation\EfcCalculation
 */
class AaiContributionCalculator
{
    private $_constants;

    /**
     * Constructs a new Contribution from Adjusted Available Income (AAI) calculator
     * @param AaiContributionCalculatorConstants $constants Constants used in the calculation of Contribution from Adjusted Available Income (AAI)
     */
    public function __construct($constants)
    {
        $this->_constants = $constants;
    }

    /**
     * Calculates Contribution from Adjusted Available Income (AAI)
     * @param EfcCalculationRole $role Role of the subject within the calculation
     * @param float $adjustedAvailableIncome Adjusted Available Income
     * @return float
     */
    public function CalculateContributionFromAai($role, $adjustedAvailableIncome)
    {
            if ($role == EfcCalculationRole::DependentStudent
                || $role == EfcCalculationRole::IndependentStudentWithoutDependents)
            {
                return EfcMathHelper::roundPositive($adjustedAvailableIncome);
            }

            $aaiContributionRanges = $this->_constants->aaiContributionRanges;
            $aaiContributionPercents = $this->_constants->aaiContributionPercents;
            $aaiContributionBases = $this->_constants->aaiContributionBases;

            if ($adjustedAvailableIncome < $aaiContributionRanges[0])
            {
                return 0;
            }

            $baseRange = 0;
            $maxIndex = count($aaiContributionRanges) - 1;

            // Loop through AAIContributionRanges until adjustedAvailableIncome param is within range
            foreach($aaiContributionRanges as $index => $range)
            {
                // If at end of ranges, set baseAmount to maximum range
                if($index == $maxIndex)
                {
                    $baseRange = $aaiContributionRanges[$index];
                    break;
                }

                // If adjustedAvailableIncome is within range
                if ($adjustedAvailableIncome < $aaiContributionRanges[$index + 1])
                {
                    // If adjustedAvailableIncome is within first range, there is no baseAmount;
                    // otherwise, assign standard baseAmount
                    $baseRange = ($index == 0) ? 0 : $range;
                    break;
                }
            }

            // Contribution From AAI = 
            //      (Base Amount for Range)
            //          + (((Adjusted Available Income) - (Lowest Value of Range)) * (Percent for Range))
            $contributionFromAai =
                $aaiContributionBases[$index]
                    + (($adjustedAvailableIncome - $baseRange) * ($aaiContributionPercents[$index] * 0.01));

            return EfcMathHelper::roundPositive($contributionFromAai);
    }
}
?>