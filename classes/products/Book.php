<?php

namespace classes\products;

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
    
    protected function setSpecificAttributes($row = null): void {
        if (is_null($row)){
            $this->setWeight($_POST['weight']);
        } else {
            $this->weight = $row['weight'];
        }
    }

    public function getSpecificAttributes(): string {
        return "Weight: $this->weight KG";
    }

    protected function getSpecificAttributesInJSON(): string {
        return json_encode(['weight' => $this->weight]);
    }

}
