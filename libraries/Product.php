<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Product
 *
 * @author xoviwyrx
 */
abstract class Product {
    
    protected string $sku;
    protected string $name;
    protected string $price;
    protected int $product_id;
    
    public function __construct(string $name, string $sku, string $price) {
        
        if (empty($name) || empty($sku) || empty($price)){
            throw new Exception("Please, submit requied data");
        }
        if (!$this->validNumberField($price)){
            throw new Exception("Please, provide the data of indicated type");
        }
        
        $this->name = $name;
        $this->sku = $sku;
        $this->price = $price;
    }
    
    protected function validNumberField($number) : bool {
            
        $pattern = '/^[0-9]+(\.[0-9]{1,2})?$/';
        if (preg_match($pattern, $number)){
                return true;
            }
        return false;
    }
    
    public function getSku(): string {
        return $this->sku;
    }
    
    public function setProductId(int $product_id): void {
        $this->product_id = $product_id;
    }

    public function getProductId(): int {
        return $this->product_id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getPrice(): string {
        return $this->price;
    }
    
    public function setSku($sku): void {
        $this->sku = $sku;
    }

    public function setName($name): void {
        $this->name = $name;
    }

    public function setPrice($price): void {
        $this->price = $price;
    }
    abstract public function setSpecificAttributes($row): void;
    abstract public function getSpecificAttributes(): string;
    
    protected function getQueryAllRecords(): string{
//        $query = "SELECT Product.sku, Product.name, Product.price, Product.spec_attributes, Type.name as type,
//                  FROM Product
//                  INNER JOIN ProductType ON
//                  Product.sku = ProductType.sku
//                  INNER JOIN Type ON
//                  ProductType.type_id = Type.type_id
//                  ";
//        $query = "SELECT Product.product_id, Product.sku, Product.name, Product.price,
//        size, weight, weight, length, height, Type.name as type
//        FROM Product
//        INNER JOIN ProductType ON
//        Product.product_id = ProductType.product_id
//        INNER JOIN Type ON
//        ProductType.type_id = Type.type_id
//        ORDER BY Product.product_id
//        ";
        $query = "SELECT product_id, sku, name, price,
        size, weight, width, length, height, type
        FROM Product
        ORDER BY product_id";
        return $query;
    }
    
    static public function getAllProductsFromDB($db): array{
        $query = "SELECT product_id, sku, name, price,
        size, weight, width, length, height, type
        FROM Product
        ORDER BY product_id
        ";
        $records = $db->select($query);
        $products = array();
        foreach ($records as $row){
           $name = $row['name'];
           $sku = $row['sku'];
           $price = $row['price'];
           $product_id = $row['product_id'];
           
//           try{
            $product = new $row['type']($name, $sku, $price);
            $product->setSpecificAttributes($row);
            $product->setProductId($product_id);
            $products[] = $product; 
//           }
//           catch (Exception $e){
//               echo $e;
//           }
        }
        return $products;
    }
    static public function deleteProductById($db, $product_id){
        $query = "DELETE FROM `Product`"
                . "WHERE product_id = ".$product_id.";";
        $db->delete($query);
    }


    abstract public function addProductToDB();
    
    public function showProduct(){
        
    }
//    abstract public function setAdditionalProperties();
//    abstract public function insertRecord(): void;
//    abstract public function getQuery(): string;

}
