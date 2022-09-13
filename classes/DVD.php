<?php

namespace classes;

/**
 * Description of DVDDisk
 *
 * @author xoviwyrx
 */
class DVD extends Product{
    private $size;
    public function getSize(): int {
        return $this->size;
    }
    public function setSize($size): void {
        $this->size = $size;
    }
    public function setSpecificAttributes($row): void {
        $size = $row['size'];
        if (empty($size)){
            throw new \Exception("Please, submit required data");
        }
        if (!$this->validNumberField($size)){
            throw new \Exception("Please, provide the data of indicated type");
        }
        $this->size = (float)$size;
    }
    public function getSpecificAttributes(): string {
        return "Size: ".$this->size." MB";
    }
    protected function getSpecificAttributesInJSON():string{
        return json_encode(['size' => $this->size]);
    }
}

