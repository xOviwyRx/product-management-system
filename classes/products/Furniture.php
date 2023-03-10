<?php

namespace classes\products;

use classes\exceptions\EmptyInputException;
use classes\exceptions\InvalidInputException;

class Furniture extends Product{
    private $width, $height, $length;

    public function setWidth($width): void {

        if (empty($width)) {
            throw new EmptyInputException;
        }

        if (!$this->validNumberField($width)) {
            throw new InvalidInputException;
        }
        
        $this->width = (float)$width;
    }
    

    public function setHeight($height): void {

        if (empty($height)) {
            throw new EmptyInputException;
        }

        if (!$this->validNumberField($height)) {
            throw new InvalidInputException;
        }
        
        $this->height = (float)$height;
    }

    public function setLength($length): void {
        
        if (empty($length)) {
            throw new EmptyInputException();
        }

        if (!$this->validNumberField($length)) {
            throw new InvalidInputException();
        }
        
        $this->length = (float)$length;
    }

    protected function setSpecificAttributesFromPOST(): void {
        $this->setHeight($_POST['height']);
        $this->setWidth($_POST['width']);
        $this->setLength($_POST['length']);
    }

    public function getSpecificAttributes(): string {
        return "Dimension: {$this->height}x{$this->width}x{$this->length}";
    }
   
    protected function getSpecificAttributesInJSON(): string {
        return json_encode(['height' => $this->height, 'width' => $this->width, 'length' => $this->length]);
    }
}
