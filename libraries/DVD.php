<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of DVDDisk
 *
 * @author xoviwyrx
 */
class DVD extends Product{
    private float $size;
    
    public function getSize(): int {
        return $this->size;
    }
    public function setSize($size): void {
        $this->size = $size;
    }
    public function insertRecord(): void {
        return;
    }
    public function setSpecificAttributes($row): void {
        $size = $row['size'];
        if (empty($size)){
            throw new Exception("Please, submit requied data");
        }
        if (!$this->validNumberField($size)){
            throw new Exception("Please, provide the data of indicated type");
        }
        $this->size = (float)$size;
    }
    public function getSpecificAttributes(): string {
        return "Size: ".$this->size." MB";
    }
    public function addProductToDB() {
        
       $db = new Database();
       $spec_attributes = json_encode(['size' => $this->size]);
       $query1 = "INSERT INTO `Product` (`sku`, `name`, `price`, `spec_attributes`)"
              . "VALUES ('$this->sku', '$this->name', '$this->price', '$spec_attributes');";
       
       $product_id = $db->insert($query1);
      
       $query2 = "INSERT INTO `ProductType` (`product_id`, `type_id`) "
              . "VALUES ('$product_id', '1');";
       $db->insert($query2);
    }
}
