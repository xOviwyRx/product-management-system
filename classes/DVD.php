<?php

namespace classes;

use classes\exceptions\EmptyInputException;
use classes\exceptions\InvalidInputException;

class DVD extends Product{
    private $size;

    public function setSize($size): void {

        if (empty($size)) {
            throw new EmptyInputException();
        }

        if (!$this->validNumberField($size)) {
            throw new InvalidInputException();
        }

        $this->size = (float)$size;
    }

    public function setSpecificAttributes(array $row): void {
        $this->setSize($row['size']);
    }

    public function getSpecificAttributes(): string {
        return "Size: $this->size MB";
    }

    protected function getSpecificAttributesInJSON(): string {
        return json_encode(['size' => $this->size]);
    }
}
