<?php

namespace classes\exceptions;

class DatabaseInsertException extends InvalidInputException{

    public function __construct($message, $code = 1) {

        if (strstr($message, 'products_unique_sku')) {
            $message = 'Product with specified SKU already exists in the database.';
        } else {
            $message = 'Database insert error.';
        }

        return parent::__construct($message, $code);
    }

}