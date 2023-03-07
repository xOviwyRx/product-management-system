<?php

namespace classes\exceptions;

class DatabaseInsertException extends \ErrorException{

    public function __construct($message, $code = 0) {

        if (strstr($message, "Duplicate entry")) {
            $message = "Product with specified SKU already exists in the database.";
        }

        return parent::__construct($message, $code);
    }
    
}