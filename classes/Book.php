<?php

namespace classes;

class Book extends Product{
    private $weight;
    public function getWeight(): float {
        return $this->weight;
    }
    public function setWeight($weight): void {
        $this->weight = $weight;
    }
    public function setSpecificAttributes($row): void {
        $weight = $row['weight'];
        if (empty($weight)){
            throw new \Exception("Please, submit required data");
        }
        if (!$this->validNumberField($weight)){
            throw new \Exception("Please, provide the data of indicated type");
        }
        $this->weight = (float)$weight;
    }
    protected function getSpecificAttributesInJSON():string{
        return json_encode(['weight' => $this->weight]);
    }

    public function getSpecificAttributes(): string {
        return "Weight: $this->weight KG";
    }
}
