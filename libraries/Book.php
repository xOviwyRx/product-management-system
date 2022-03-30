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
//        $this->weight = filter_input(INPUT_POST, 'Weight');
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
//         $this->weight = filter_input(INPUT_POST, 'Weight');
    }
    public function getSpecificAttributes(): string {
        return "Weight: ".$this->weight." KG";
    }
    public function addProductToDB(){
       $db = new Database();
//       print $this->sku;
       
       $query1 = "INSERT INTO `Product` (`sku`, `name`, `price`, `weight`, `type`) "
              . "VALUES ('$this->sku', '$this->name', '$this->price', '$this->weight', 'Book');";
//       $query2 = "INSERT INTO `ProductType` (`product_id`, `type_id`) VALUES ('$this->product_id', '2');";
       $db->insert($query1);
//       $db->insert($query2);
//       header("Location: index.php?msg=".urlencode('Record Added'));
       
       

    }
}
