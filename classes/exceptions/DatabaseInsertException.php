<?php

namespace classes\exceptions;

class DatabaseInsertException extends InvalidInputException{

    public function __construct($message, $code = 1) {

        if (strstr($message, "Duplicate entry")) {
            $message = "Product with specified SKU already exists in the database.";
        }

        return parent::__construct($message, $code);
    }

}