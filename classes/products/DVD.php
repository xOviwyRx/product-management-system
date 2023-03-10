<?php

namespace classes\products;

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

    protected function setSpecificAttributes($row = null): void {
        if (is_null($row)) {
            $this->setSize($_POST['size']);
        } else {
            $this->size = $row['size'];
        }
    }

    public function getSpecificAttributes(): string {
        return "Size: $this->size MB";
    }

    protected function getSpecificAttributesInJSON(): string {
        return json_encode(['size' => $this->size]);
    }
}
