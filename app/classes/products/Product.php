<?php
///Think about separting app (with classes) and public directories(with html code)
namespace classes\products;

use classes\Database;
use classes\exceptions\EmptyInputException;
use classes\exceptions\InvalidInputException;

abstract class Product
{

    protected $sku, $name, $price, $product_id;
    static protected $db;

    static function setDatabase(Database $database)
    {
        self::$db = $database->connection;
    }

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

    public function setPrice(string $price = ''): void
    {
        if ($price === '') {
            throw new EmptyInputException();
        } elseif (!$this->isValidNumberField($price, '/^[0-9]+(\.[0-9]{1,2})?$/')) {
            throw new InvalidInputException();
        }

        $this->price = (float)$price;
    }

    abstract public function setSpecificAttributes(array $row): void;

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

    protected function isValidNumberField(
        string $number,
        string $pattern = '/^[0-9]+(\.[0-9]{1})?$/')
    : bool
    {
        return preg_match($pattern, $number);
    }

    static protected function instantiate($record): self
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
        $sql_all_products = self::selectAllProductsQuery();
        $result_set = self::$db->query($sql_all_products);
        $product_objects = [];

        while ($record = $result_set->fetch_assoc()) {
            $product_objects[] = self::getClassName($record['type'])::instantiate($record);
        }

        $result_set->free();
        return $product_objects;
    }

    static public function deleteCheckedProducts(array $checked_products): void
    {
        if (!empty($checked_products)) {
            $count = sizeof($checked_products);
            $parameters = str_repeat('?,', $count - 1) . '?';
            $sql = "DELETE FROM products WHERE product_id IN ($parameters)";
            $pst = self::$db->prepare($sql);
            $types = str_repeat('s', $count);
            $pst->bind_param($types, ...$checked_products);
            $pst->execute();
            $pst->close();
        }
    }

    public function save(): void
    {
        $sql = "INSERT INTO products (name, sku, price) VALUES (?, ?, ?)";
        $pst = self::$db->prepare($sql);
        $pst->bind_param("sss", $this->name, $this->sku, $this->price);
        $pst->execute();
        Database::checkDatabaseInsertError($pst);
        $this->product_id = $pst->insert_id;
        $pst->close();
    }

    private static function getClassName(string $name): string {
        return "classes\\products\\{$name}";
    }

    public static function getClassNameInput(string $name): string
    {
        if (empty($name)) {
            throw new EmptyInputException();
        }

        $class_name = self::getClassName($name);

        if (!is_subclass_of($class_name, self::class)) {
            throw new InvalidInputException();
        }

        return $class_name;

    }
}
