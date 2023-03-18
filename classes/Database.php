<?php

namespace classes;

use classes\exceptions\DatabaseInsertException;
use mysqli;

class Database
{
    public $connection;

    public function __construct()
    {
        $this->connect();
    }

    private function connect(): void
    {
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($this->connection->connect_error) {
            $msg = "Database connection failed: ";
            $msg .= $this->connection->connect_error;
            $msg .= " (" . $this->connection->connect_errno . ")";
            die($msg);
        }
    }

    public function __destruct()
    {
        $this->connection->close();
    }
}
