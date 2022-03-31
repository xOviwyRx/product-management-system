<?php

namespace classes;

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
    public function setSpecificAttributes($row): void {
        $weight = $row['weight'];
        if (empty($weight)){
            throw new \Exception("Please, submit requied data");
        }
        if (!$this->validNumberField($weight)){
            throw new \Exception("Please, provide the data of indicated type");
        }
        $this->weight = (float)$weight;
    }
    public function getSpecificAttributes(): string {
        return "Weight: ".$this->weight." KG";
    }
    public function addProductToDB($db){
//       $db = new Database();
       $spec_attributes = json_encode(['weight' => $this->weight]);
       $query1 = "INSERT INTO `Product` (`sku`, `name`, `price`, `spec_attributes`)"
              . "VALUES ('$this->sku', '$this->name', '$this->price', '$spec_attributes');";
       
       $product_id = $db->insert($query1);
      
       $query2 = "INSERT INTO `ProductType` (`product_id`, `type_id`) "
              . "VALUES ('$product_id', '2');";
       $db->insert($query2);
    }
}
