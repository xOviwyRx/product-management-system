<?php

namespace classes;

use mysqli;

class Database{
    public $host = DB_HOST;
    private $username = DB_USER;
    private $password = DB_PASS;
    private $db_name = DB_NAME;

    public $link;
    public $error;

    public function __construct(){
        $this->connect();
    }
    
    public function __destruct()
    {
        $this->link->close();
    }

    private function connect(): void {
        $this->link = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        if ($this->link->connect_error){
            $this->error = "Database connection fail: ".$this->link->connect_error;
        }
    }
    
    public function select(string $query) {
        $result = $this->link->query($query) or die($this->link->error.__LINE__);
        return $result;
    }
    
    public function addNewProductToDB(string $sku, string $name, string $price, string $spec_attributes): int {
        $pst = $this->link->prepare("INSERT INTO `Product`"
                                      . " (`sku`, `name`, `price`, `spec_attributes`) VALUES (?, ?, ?, ?);");
        $pst->bind_param("ssss", $sku, $name, $price, $spec_attributes);
        $insert_row = $pst->execute();
        if (!$insert_row){  
            $error = $pst->error;
            $error_description = strstr($error, "Duplicate entry") ? "Product with specified SKU already exists in the database." : $error;
            throw new \Exception($error_description);
        }
        else
        {
            return $pst->insert_id;
        }
    }

    public function do_query(string $query): void {
        $this->link->query($query) or die($this->link->error.__LINE__);
    }
}
