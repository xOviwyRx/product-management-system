<?php

namespace classes\products;

use classes\Database;
use classes\exceptions\EmptyInputException;
use classes\exceptions\InvalidInputException;

class Furniture extends Product
{
    protected $width, $height, $length;

    public function setWidth(string $width): void
    {

        if (empty($width)) {
            throw new EmptyInputException;
        }

        if (!$this->isvalidNumberField($width)) {
            throw new InvalidInputException;
        }

        $this->width = (float)$width;
    }


    public function setHeight(string $height): void
    {

        if (empty($height)) {
            throw new EmptyInputException;
        }

        if (!$this->isValidNumberField($height)) {
            throw new InvalidInputException;
        }

        $this->height = (float)$height;
    }

    public function setLength(string $length): void
    {

        if (empty($length)) {
            throw new EmptyInputException();
        }

        if (!$this->isValidNumberField($length)) {
            throw new InvalidInputException();
        }

        $this->length = (float)$length;
    }

    public function setSpecificAttributes(array $row): void
    {
        $this->setHeight($row['height']);
        $this->setWidth($row['width']);
        $this->setLength($row['length']);
    }

    public function getSpecificAttributes(): string
    {
        return "Dimension: {$this->height}x{$this->width}x{$this->length}";
    }

    public function save(): void
    {
        parent::save();
        $sql = "INSERT INTO furniture (product_id, width, height, length) VALUES (?, ?, ?, ?)";
        $pst = self::$db->prepare($sql);
        $pst->bind_param("iddd", $this->product_id, $this->width, $this->height, $this->length);
        $pst->execute();
        Database::checkDatabaseInsertError($pst);
        $pst->close();
    }
}
