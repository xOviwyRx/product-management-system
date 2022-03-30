<?php

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
    
    private function connect(){
    $this->link = new mysqli($this->host, $this->username, $this->password, $this->db_name);
    if ($this->link->connect_error){
        $this->error = "Connection fail:".$this->link->connection_error;
        return false;
       }
    }
    
    public function select($query){
        $result = $this->link->query($query) or die($this->link->error.__LINE__);
        if ($result->num_rows > 0){
            return $result;
        } else {
            return false;
        }
    }
    
    public function insert($query){
        $insert_row = $this->link->query($query) or die($this->link->error.__LINE__);
        
        if (!$insert_row){
            die('Error : ('. $this->link->errno .') '. $this->link->error);
        }
    }
    
     public function update($query){
        $update_row = $this->link->query($query) or die($this->link->error.__LINE__);
        
        if ($update_row){
            header("Location: index.php?msg=".urlencode('Record Updated'));
            exit();
        } else{
            die('Error : ('. $this->link->errno .') '. $this->link->error);
        }
    }
    
    public function delete($query){
        $delete_row = $this->link->query($query) or die($this->link->error.__LINE__);
        
        if (!$delete_row){
            die('Error : ('. $this->link->errno .') '. $this->link->error);
        }
    }
}
    



