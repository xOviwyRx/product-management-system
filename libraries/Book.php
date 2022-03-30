<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Book
 *
 * @author xoviwyrx
 */
class Book extends Product{
    private float $weight;
    public function getWeight(): float {
        return $this->weight;
    }
    public function setWeight($weight): void {
        $this->weight = $weight;
    }
    public function insertRecord(): void {
        return;
    }
    public function setSpecificAttributes($row): void {
        $weight = $row['weight'];
        if (empty($weight)){
            throw new Exception("Please, submit requied data");
        }
        if (!$this->validNumberField($weight)){
            throw new Exception("Please, provide the data of indicated type");
        }
        $this->weight = (float)$weight;
    }
    public function getSpecificAttributes(): string {
        return "Weight: ".$this->weight." KG";
    }
    public function addProductToDB(){
       $db = new Database();
       
       $query1 = "INSERT INTO `Product` (`sku`, `name`, `price`, `weight`, `type`) "
              . "VALUES ('$this->sku', '$this->name', '$this->price', '$this->weight', 'Book');";
       $db->insert($query1);
    }
}
