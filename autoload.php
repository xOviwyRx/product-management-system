<?php
spl_autoload_register(function($classname) {
        include_once $_SERVER['DOCUMENT_ROOT'].'/'.str_replace("\\", "/", $classname) . '.php';
});
