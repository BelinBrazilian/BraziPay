<?php

namespace App\Exceptions;

use Exception;

class InvalidPhoneAssociationException extends Exception
{
    public function __construct(
        $message = "A phone must be associated with either a customer or a merchant, not both or neither.", 
        $code = 0, 
        Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
