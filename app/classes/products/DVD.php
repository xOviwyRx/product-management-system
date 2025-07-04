<?php

namespace classes\products;

use classes\Database;
use classes\exceptions\EmptyInputException;
use classes\exceptions\InvalidInputException;

class DVD extends Product
{
    protected $size;

    public function setSize(string $size): void
    {

        if (empty($size)) {
            throw new EmptyInputException();
        }

        if (!$this->isValidNumberField($size)) {
            throw new InvalidInputException();
        }

        $this->size = (float)$size;
    }

    public function setSpecificAttributes(array $row): void
    {
        $this->setSize($row['size']);
    }

    public function getSpecificAttributes(): string
    {
        return "Size: $this->size MB";
    }

    public function save(): void
    {
        parent::save();
        $sql = "INSERT INTO dvds (product_id, size) VALUES (?, ?)";
        $pst = self::$db->prepare($sql);
        $pst->bind_param("is", $this->product_id, $this->size);
        $pst->execute();
        Database::checkDatabaseInsertError($pst);
        $pst->close();
    }
}
