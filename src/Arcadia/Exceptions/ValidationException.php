<?php

namespace Arcadia\Exceptions;

use Exception;

/**
 * Class ValidationException
 * @package Arcadia\Exceptions
 */
class ValidationException extends Exception
{
    private array $errors;
    
    public function __construct(string $message, array $errors)
    {
        parent::__construct($message, 422, null);
        
        $this->errors = $errors;
    }
    
    public function getErrors() : array
    {
        return $this->errors;
    }
}
