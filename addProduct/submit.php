<?php

use classes\Database;
use classes\products\Product;
use classes\exceptions\InvalidInputException;

require '../config/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/autoload.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (empty($_POST['typeswitcher'])) {
        echo json_encode(['code' => '1', 'msg' => 'Please, submit required data']);
        exit;
    }

    $db = new Database();
    Product::setDatabase($db);
    $class_name = "classes\\products\\" . $_POST['typeswitcher'];
    $product = new $class_name();
    try {
        $product->setName($_POST['name']);
        $product->setSku($_POST['sku']);
        $product->setPrice($_POST['price']);
        $product->setSpecificAttributes($_POST);
    } catch (InvalidInputException $e) {
        echo json_encode(['code' => $e->getCode(), 'msg' => $e->getMessage()]);
    };
    $product->save();
    echo json_encode(['code' => '200', 'msg' => 'success']);
} else {
    header("Location: index.php");
    exit;
}
