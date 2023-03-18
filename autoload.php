<?php
//think about autoloading only from classes directory
spl_autoload_register(function ($classname) {
        // var_dump($classname);
        require_once $_SERVER['DOCUMENT_ROOT'] . '/' . str_replace("\\", "/", $classname) . '.php';
        // require_once 
});
