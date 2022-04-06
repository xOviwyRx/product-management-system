<?php

namespace classes;


/**
 * Description of Product
 *
 * @author xoviwyrx
 */
abstract class Product {
    
    protected $sku;
    protected $name;
    protected $price;
    protected $product_id;
    
    public function __construct(string $name, string $sku, string $price) {
        
        if (empty($name) || empty($sku) || empty($price)){
            throw new \Exception("Please, submit required data");
        }
        if (!$this->validNumberField($price, '/^[0-9]+(\.[0-9]{1,2})?$/')){
            throw new \Exception("Please, provide the data of indicated type");
        }
        
        $this->name = $name;
        $this->sku = $sku;
        $this->price = $price;
    }
    
    protected function validNumberField($number, $pattern = '/^[0-9]+(\.[0-9]{1})?$/') : bool {
            
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
    
    static protected function getQueryAllRecords(): string{
        $query = "SELECT sku, Product.name, price, spec_attributes, Type.name as type, Product.product_id
                  FROM Product
                  INNER JOIN ProductType ON
                  Product.product_id = ProductType.product_id
                  INNER JOIN Type ON
                  ProductType.type_id = Type.type_id
                  ORDER BY Product.product_id
                  ";
        return $query;
    }
    
    static public function getAllProductsFromDB($db): array{
        $query = Product::getQueryAllRecords();
        $records = $db->select($query);
        $products = array();
        foreach ($records as $row){
           $name = $row['name'];
           $sku = $row['sku'];
           $price = $row['price'];
           $product_id = $row['product_id'];
           $className = "classes\\".$row['type'];
           $spec_attributes = json_decode($row['spec_attributes'], true);
           
//           try{
           $product = new $className($name, $sku, $price);
           $product->setSpecificAttributes($spec_attributes);
           $product->setProductId($product_id);
           $products[] = $product; 
//           }
//           catch (Exception $e){
//               echo $e;
//           }
        }
        return $products;
    }
    
    static public function deleteCheckedProducts($db, $checked_products){
        if (!empty($checked_products)){
                    foreach ($checked_products as $product_id){
                        Product::deleteProductById($db, $product_id);
                    }
                    header("Location: index.php");
                }
    }
    static private function deleteProductById($db, $product_id){
        $query1 = "DELETE FROM `ProductType`"
                . "WHERE product_id = ".$product_id.";";
        $db->delete($query1);
        
        $query2 = "DELETE FROM `Product`"
                . "WHERE product_id = ".$product_id.";";
        $db->delete($query2);
    }
    abstract protected function getSpecificAttributesInJSON() : string;
    
    public function getClassName():string{
        $path = explode('\\', static::class);
        return array_pop($path);
    }
    private function getTypeId($db):int{
       $query_select = "SELECT type_id FROM Type WHERE name = '".$this->getClassName()."';";
       return $db->select($query_select)->fetch_row()[0];
    }
    
    static public function saveProduct($db, $rows){
        $typeswitcher = $rows['typeswitcher'];
        if (!empty($typeswitcher)){
            $name = $rows['name'];
            $sku = $rows['sku'];
            $price = $rows['price'];
            $type = "classes\\".$typeswitcher;
            try
            {
                $product = new $type($name, $sku, $price);
                $product->setSpecificAttributes($rows);
                $product->addProductToDB($db);
                echo json_encode(['code'=>'200', 'msg'=>'success']);
            }
            catch(\Exception $e){
                echo json_encode(['code'=>'404', 'msg'=>$e->getMessage()]);
            }
        }
        else{
           echo json_encode(['code'=>'404', 'msg'=>'Please, submit required data']); 
        }
    }
    private function addProductToDB($db){
        $spec_attributes = $this->getSpecificAttributesInJSON();
        $query_insert = "INSERT INTO `Product` (`sku`, `name`, `price`, `spec_attributes`)"
                       . "VALUES ('".$this->sku."', '".$this->name."', '".$this->price."', '$spec_attributes');";
        $product_id = $db->insert($query_insert);
        $type_id = $this->getTypeId($db);
        $query_insert = "INSERT INTO `ProductType` (`product_id`, `type_id`) "
                       . "VALUES ('$product_id', '$type_id');";
        $db->insert($query_insert);
    }
    
    public function showProduct(){
        
    }

}
