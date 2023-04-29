<?php

namespace classes\products;

use classes\Database;
use classes\exceptions\EmptyInputException;
use classes\exceptions\InvalidInputException;

class Book extends Product
{
    protected $weight;

    public function setWeight(string $weight): void
    {

        if ($weight === '') {
            throw new EmptyInputException();
        }

        if (!$this->isValidNumberField($weight)) {
            throw new InvalidInputException();
        }

        $this->weight = $weight;
    }

    public function setSpecificAttributes(array $row): void
    {
        $this->setWeight($row['weight']);
    }

    public function getSpecificAttributes(): string
    {
        return "Weight: $this->weight KG";
    }

    public function save(): void
    {
        parent::save();
        $sql = "INSERT INTO books (product_id, weight) VALUES (?, ?)";
        $pst = self::$db->prepare($sql);
        $pst->bind_param("is", $this->product_id, $this->weight);
        $pst->execute();
        Database::checkDatabaseInsertError($pst);
        $pst->close();
    }
}
