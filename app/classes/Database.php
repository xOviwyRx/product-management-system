<?php

namespace classes;

use classes\exceptions\DatabaseInsertException;
use mysqli;

class Database
{
    //don't use public here
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

    public static function checkDatabaseInsertError($pst): void {
        if ($pst->errno) {
            $error = $pst->error;
            $pst->close();
            throw new DatabaseInsertException($error);
        }
    }

    public function __destruct()
    {
        $this->connection->close();
    }
}
