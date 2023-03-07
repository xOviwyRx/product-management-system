<?php

namespace classes;

use classes\exceptions\EmptyInputException;
use classes\exceptions\InvalidInputException;

class Book extends Product{
    private $weight;

    public function setWeight($weight): void {

        if (empty($weight)) {
            throw new EmptyInputException();
        }

        if (!$this->validNumberField($weight)) {
            throw new InvalidInputException();
        }
        
        $this->weight = $weight;
    }
    
    public function setSpecificAttributes(array $row): void {
        $this->setWeight($row['weight']);
    }

    public function getSpecificAttributes(): string {
        return "Weight: $this->weight KG";
    }

    protected function getSpecificAttributesInJSON(): string {
        return json_encode(['weight' => $this->weight]);
    }

}
