<?php

namespace classes;

/**
 * Description of Furniture
 *
 * @author xoviwyrx
 */
class Furniture extends Product{
    private $width;
    private $height;
    private $length;
    
    public function getWidth(): float {
        return $this->width;
    }

    public function getHeight(): float {
        return $this->height;
    }

    public function getLength(): float {
        return $this->length;
    }
    
    public function setWidth(float $width): void {
        $this->width = $width;
    }

    public function setHeight(float $height): void {
        $this->height = $height;
    }

    public function setLength(float $length): void {
        $this->length = $length;
    }
    public function setSpecificAttributes($row): void {
        $heigth = $row['height'];
        $width = $row['width'];
        $length = $row['length'];
        if (empty($heigth) || empty($width) || empty ($length)){
            throw new \Exception("Please, submit required data");
        }
        if (!$this->validNumberField($heigth)
              ||  !$this->validNumberField($width)
                || !$this->validNumberField($length)){
            throw new \Exception("Please, provide the data of indicated type");
        }
        
        $this->height = (float)$heigth;
        $this->width = (float)$width;
        $this->length = (float)$length;
        
    }
    public function getSpecificAttributes(): string {
        return "Dimension: ".$this->height.'x'.$this->width.'x'.$this->length;
    }
    public function addProductToDB($db) {
       
//       $db = new Database();
       
       $spec_attributes = json_encode(['height' => $this->height, 'width' => $this->width, 'length' => $this->length]);
       $query1 = "INSERT INTO `Product` (`sku`, `name`, `price`, `spec_attributes`)"
              . "VALUES ('$this->sku', '$this->name', '$this->price', '$spec_attributes');";
       
       $product_id = $db->insert($query1);
       
       $query2 = "INSERT INTO `ProductType` (`product_id`, `type_id`) "
              . "VALUES ('$product_id', '3');";
       $db->insert($query2);
    }


}
