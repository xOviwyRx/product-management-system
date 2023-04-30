<?php

namespace classes\exceptions;

class EmptyInputException extends InvalidInputException{

    public function __construct() {
        return parent::__construct('Please, submit required data');
    }
    
}