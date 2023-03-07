<?php

namespace classes;

use classes\exceptions\DatabaseInsertException;
use mysqli;

class Database{
    public $link, $error;

    public function __construct(){
        $this->connect();
    }
    
    public function __destruct()
    {
        $this->link->close();
    }

    private function connect(): void {
        $this->link = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($this->link->connect_error) {
            $this->error = "Database connection fail: " . $this->link->connect_error;
        }
    }
    
    public function select(string $query) {
        $result = $this->link->query($query) or die($this->link->error . __LINE__);
        return $result;
    }
    
    public function addNewProductToDB(string $sku, string $name, float $price, string $spec_attributes): int {
        $pst = $this->link->prepare("INSERT INTO `Product`"
                                      . " (`sku`, `name`, `price`, `spec_attributes`) VALUES (?, ?, ?, ?);");
        $pst->bind_param("ssss", $sku, $name, $price, $spec_attributes);
        $insert_row = $pst->execute();

        if (!$insert_row) {  
            throw new DatabaseInsertException($pst->error);
        } else {
            return $pst->insert_id;
        }
    }

    public function do_query(string $query): void {
        $this->link->query($query) or die($this->link->error . __LINE__);
    }
}
