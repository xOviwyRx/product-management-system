<?php

namespace classes\exceptions;

class InvalidInputException extends \InvalidArgumentException{

    public function __construct($message = 'Please, provide the data of indicated type', $code = 0) {
        return parent::__construct($message, $code);
    }
    
}