<?php

namespace classes\products;
use classes\Database;
use classes\exceptions\EmptyInputException;
use classes\exceptions\InvalidInputException;

abstract class Product {

    protected $sku, $name, $price, $product_id;

    abstract public function getSpecificAttributes(): string;
    abstract protected function getSpecificAttributesInJSON(): string;
    abstract protected function setSpecificAttributes($row): void;

    public function __construct(string $name, string $sku, $price) {
        $name = trim($name);
        $sku = trim($sku);
        
        if (empty($name) || empty($sku) || empty($price)) {
            throw new EmptyInputException();
        }

        if (!$this->validNumberField($price, '/^[0-9]+(\.[0-9]{1,2})?$/')) {
            throw new InvalidInputException();
        }

        $this->name = $name;
        $this->sku = $sku;
        $this->price = (float)$price;
    }

    protected function validNumberField(string $number, string $pattern = '/^[0-9]+(\.[0-9]{1})?$/'): bool {
        return preg_match($pattern, $number);
    }

    public function getSku(): string {
        return htmlspecialchars($this->sku);
    }

    public function getName(): string {
        return htmlspecialchars($this->name);
    }

    public function getPrice(): string {
        return $this->price;
    }

    public function setProductId(int $product_id): void {
        $this->product_id = $product_id;
    }

    public function getProductId(): int {
        return $this->product_id;
    }

    static protected function getQueryAllRecords(): string {
        return "SELECT sku, Product.name, price, spec_attributes, Type.name as type, Product.product_id
                  FROM Product
                  INNER JOIN ProductType ON
                  Product.product_id = ProductType.product_id
                  INNER JOIN Type ON
                  ProductType.type_id = Type.type_id
                  ORDER BY Product.product_id";
    }

    static public function getAllProductsFromDB(Database $db): array {
        $query = self::getQueryAllRecords();
        $records = $db->select($query);
        //where is fetch for your query???
        $products = [];

        foreach ($records as $row) {
           $products[] = self::createProductFromDB($row);
        //    $name = $row['name'];
        //    $sku = $row['sku'];
        //    $price = $row['price'];
        //    $product_id = $row['product_id'];
        //    $class_name = 'classes\\products\\' . $row['type'];
        //    $spec_attributes = json_decode($row['spec_attributes'], true);
        //    $product = new $class_name($name, $sku, $price, $spec_attributes, $product_id);
        //    $product->setSpecificAttributes($spec_attributes);
        //    $product->setProductId($product_id);
           $products[] = $product;
        }
        return $products;
    }

    static public function deleteCheckedProducts(Database $db, array $checked_products): void {
        if (!empty($checked_products)) {

            foreach ($checked_products as $product_id){
                self::deleteProductById($db, $product_id);
            }
            
            header("Location: index.php");
        }
    }
    
    static private function deleteProductById(Database $db, int $product_id): void {
        $query1 = "DELETE FROM `ProductType`"
                . "WHERE product_id = '" . $product_id . "'";
        $db->do_query($query1);

        $query2 = "DELETE FROM `Product`"
                . "WHERE product_id = '" . $product_id . "'";
        $db->do_query($query2);
    }
    

    public function getClassName() : string {
        $path = explode('\\', static::class);
        return array_pop($path);
    }
    
    private function getTypeId(Database $db): int {
       $query_select = "SELECT type_id FROM Type WHERE name = '{$this->getClassName()}';";
       return $db->select($query_select)->fetch_row()[0];
    }

    static public function saveProduct(Database $db): void {
        if (!empty($_POST['typeswitcher'])) {
            $class_name = "classes\\products\\" . $_POST['typeswitcher'];
            $name = $_POST['name'];
            $sku = $_POST['sku'];
            $price = $_POST['price'];

            try {
                $product = new $class_name($name, $sku, $price);
                $product->setSpecificAttributesFromPOST();
                $product->addProductToDB($db);
                echo json_encode(['code'=>'200', 'msg'=>'success']);
            } catch (InvalidInputException $e) {
                echo json_encode(['code'=>$e->getCode(), 'msg'=>$e->getMessage()]);
            }

        } else {
           echo json_encode(['code'=>'1', 'msg'=>'Please, submit required data']);
        }
    }
    
    private function addProductToDB(Database $db): void {
        $spec_attributes = $this->getSpecificAttributesInJSON();
        $product_id = $db->addNewProductToDB($this->sku, $this->name, $this->price, $spec_attributes);
        $type_id = $this->getTypeId($db);
        $query_insert = "INSERT INTO `ProductType` (`product_id`, `type_id`) "
                       . "VALUES ('$product_id', '$type_id');";
        $db->do_query($query_insert);
    }

}