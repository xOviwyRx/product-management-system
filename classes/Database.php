<?php

namespace classes;

use mysqli;

class Database{
    public $host = DB_HOST;
    private $username = DB_USER;
    private $password = DB_PASS;
    private $db_name = DB_NAME;
    private $pst;

    public $link;
    public $error;

    public function __construct(){
         $this->connect();
         $this->pst = $this->link->prepare("INSERT INTO `Product`"
                                      . " (`sku`, `name`, `price`, `spec_attributes`) VALUES (?, ?, ?, ?);");
    }

    private function connect(){
    $this->link = new mysqli($this->host, $this->username, $this->password, $this->db_name);
    if ($this->link->connect_error){
        $this->error = "Connection fail: ".$this->link->connect_error;
        return false;
       }
    }

    public function select($query){
        $result = $this->link->query($query) or die($this->link->error.__LINE__);
        return $result;
    }
    
    public function addNewProductToDB($sku, $name, $price, $spec_attributes){
        $this->pst->bind_param("ssss", $sku, $name, $price, $spec_attributes);
        $insert_row = $this->pst->execute();
        if (!$insert_row){  
            $error = $this->pst->error;
            $error_description = strstr($error, "Duplicate entry") ? "Product with specified SKU already exists in the database." : $error;
            throw new \Exception($error_description);
        }
        else
        {
            return $this->pst->insert_id;
        }
    }

    public function insert($query) : string{
        $insert_row = $this->link->query($query);

        if (!$insert_row){
            $error = $this->link->error;
            $error_description = strstr($error, "Duplicate entry") ? "Product with specified SKU already exists in the database." : $error;
            throw new \Exception($error_description);
        }
        else
        {
            return $this->link->insert_id;
        }
    }

    public function delete($query){
        $delete_row = $this->link->query($query) or die($this->link->error.__LINE__);
        if (!$delete_row){
            die('Error : ('. $this->link->errno .') '. $this->link->error);
        }
    }
}
