<?php
namespace Ucsb\Sa\FinAid\AidEstimation\Utility;

/**
 * @package Ucsb\Sa\FinAid\AidEstimation\Utility
 */
class ValidationError
{
    /**
     * Name of the parameter that caused the validation error
     * @var string
     */
    public $parameter;

    /**
     * Message describing the validation error
     * @var string
     */
    public $message;

    public function __construct($parameter, $message)
    {
        $this->parameter = $parameter;
        $this->message = $message;
    }
}
?>