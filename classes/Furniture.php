<?php

namespace classes;

class Furniture extends Product{
    private $width;
    private $height;
    private $length;

    public function setWidth($width): void {

        if (empty($width)) {
            throw new \Exception("Please, submit required data");
        }

        if (!$this->validNumberField($width)) {
            throw new \Exception("Please, provide the data of indicated type");
        }
        
        $this->width = (float)$width;
    }
    

    public function setHeight($height): void {

        if (empty($height)) {
            throw new \Exception("Please, submit required data");
        }

        if (!$this->validNumberField($height)) {
            throw new \Exception("Please, provide the data of indicated type");
        }
        
        $this->height = (float)$height;
    }

    public function setLength($length): void {
        
        if (empty($length)) {
            throw new \Exception("Please, submit required data");
        }

        if (!$this->validNumberField($length)) {
            throw new \Exception("Please, provide the data of indicated type");
        }
        
        $this->length = (float)$length;
    }

    public function setSpecificAttributes(array $row): void {
        $this->setHeight($row['height']);
        $this->setWidth($row['width']);
        $this->setLength($row['length']);
    }

    public function getSpecificAttributes(): string {
        return "Dimension: {$this->height}x{$this->width}x{$this->length}";
    }
   
    protected function getSpecificAttributesInJSON(): string {
        return json_encode(['height' => $this->height, 'width' => $this->width, 'length' => $this->length]);
    }
}
