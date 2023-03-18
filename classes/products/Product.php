<?php
///Think about separting private (with classes) and public directories(with html code)
namespace classes\products;

use NumberFormatter;
use classes\Database;
use classes\exceptions\EmptyInputException;
use classes\exceptions\InvalidInputException;

abstract class Product
{

    protected $sku, $name, $price, $product_id;
    static protected $db;

    static function setDatabase($database)
    {
        self::$db = $database->connection;
    }

    // Setters 
    public function setName(string $name = ''): void
    {
        $name = trim($name);

        if ($name === '') {
            throw new EmptyInputException();
        }

        $this->name = $name;
    }

    public function setSku(string $sku = ''): void
    {
        $sku = trim($sku);

        if ($sku === '') {
            throw new EmptyInputException();
        }

        $this->sku = $sku;
    }

    public function setPrice($price = ''): void
    {
        if ($price === '') {
            throw new EmptyInputException();
        } elseif (!$this->isValidNumberField($price, '/^[0-9]+(\.[0-9]{1,2})?$/')) {
            throw new InvalidInputException();
        }

        $this->price = (float)$price;
    }

    public function setProductId(int $product_id): void
    {
        $this->product_id = $product_id;
    }

    abstract public function setSpecificAttributes($row): void;
    // END Setters 

    // Getters
    public function getSku(): string
    {
        return htmlspecialchars($this->sku);
    }

    public function getName(): string
    {
        return htmlspecialchars($this->name);
    }

    public function getPrice(): string
    {
        return $this->price . '$';
    }

    public function getProductId(): int
    {
        return $this->product_id;
    }

    abstract public function getSpecificAttributes(): string;
    // END Getters

    // Validators
    protected function isValidNumberField(string $number, string $pattern = '/^[0-9]+(\.[0-9]{1})?$/'): bool
    {
        return preg_match($pattern, $number);
    }
    // END Validators


    //Maybe it will be better replace it by something else?
    static protected function instantiate($record)
    {
        $object = new static;
        foreach ($record as $property => $value) {
            if (property_exists($object, $property)) {
                $object->$property = $value;
            }
        }
        return $object;
    }

    static private function selectAllProductsQuery(): string
    {
        return "SELECT p.product_id, p.sku, p.name, p.price, b.weight, d.size, f.length, f.height, f.width,
                CASE
                    WHEN d.product_id IS NOT NULL THEN 'DVD'
                    WHEN f.product_id IS NOT NULL THEN 'Furniture'
                    WHEN b.product_id IS NOT NULL THEN 'Book'
                END
                AS type
                FROM products AS p
                LEFT JOIN books AS b ON
                p.product_id = b.product_id
                LEFT JOIN dvds AS d ON
                p.product_id = d.product_id
                LEFT JOIN furniture AS f ON
                p.product_id = f.product_id
                ORDER BY p.product_id";
    }

    static public function all(): array
    {
        $sql = self::selectAllProductsQuery();
        $result_set = self::$db->query($sql);
        $product_objects = [];

        while ($record = $result_set->fetch_assoc()) {
            $class_name = 'classes\\products\\' . $record['type'];
            $product_objects[] = $class_name::instantiate($record);
        }

        $result_set->free();
        return $product_objects;
    }

    static public function deleteCheckedProducts($checked_products): void
    {
        // Please do binding to the objects !!!
        if (!empty($checked_products)) {
            $sql = "DELETE FROM products WHERE product_id = ?";
            $pst = self::$db->prepare($sql);
            foreach ($checked_products as $product_id) {
                // do i need casting type here?
                $param = (int)$product_id;
                $pst->bind_param("i", $param);
                $pst->execute();
            }
            $pst->close();
            header("Location: index.php");
        }
    }

    public function save()
    {
        $sql = "INSERT INTO products (name, sku, price) VALUES (?, ?, ?)";
        $pst = self::$db->prepare($sql);
        $pst->bind_param("sss", $this->name, $this->sku, $this->price);
        $pst->execute();
        $this->product_id = $pst->insert_id;
        $pst->close();
    }
}
