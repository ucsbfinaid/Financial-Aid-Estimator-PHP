<?php
namespace Ucsb\Sa\FinAid\AidEstimation\EfcCalculation;

abstract class EfcCalculationRole
{
    const IndependentStudentWithDependents = 0;
    const IndependentStudentWithoutDependents = 1;
    const DependentStudent = 2;
    const Parent = 3;
}
?>