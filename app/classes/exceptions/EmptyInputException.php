<?php

namespace classes\exceptions;

class EmptyInputException extends InvalidInputException{

    public function __construct($message = 'Please, submit required data', $code = 0) {
        return parent::__construct($message, $code);
    }
    
}