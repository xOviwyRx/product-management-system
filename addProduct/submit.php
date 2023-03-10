<?php
use classes\products\Product;

require '../config/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/autoload.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $db = new classes\Database();
    Product::saveProduct($db);
} else {
    header("Location: index.php");
    exit;
}
