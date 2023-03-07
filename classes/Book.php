<?php

namespace classes;

class Book extends Product{
    private $weight;

    public function setWeight($weight): void {
        if (empty($weight)) {
            throw new \Exception("Please, submit required data");
        }
        if (!$this->validNumberField($weight)) {
            throw new \Exception("Please, provide the data of indicated type");
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
