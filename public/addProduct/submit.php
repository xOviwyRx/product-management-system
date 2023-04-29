<?php

use classes\exceptions\InvalidInputException;
use classes\products\Product;
use classes\Page;

//think about how to avoid re-initialization here

require '../../app/initialize.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $class_name = Product::getClassNameInput($_POST['typeswitcher']);
        $product = new $class_name;
        $product->setName($_POST['name']);
        $product->setSku($_POST['sku']);
        $product->setPrice($_POST['price']);
        $product->setSpecificAttributes($_POST);
        $product->save();
        echo json_encode(['code' => '200', 'msg' => 'success']);
    } catch (InvalidInputException $e) {
        echo json_encode(['code' => $e->getCode(), 'msg' => $e->getMessage()]);
    };
} else {
    Page::redirectTo('addProduct/index.php');
}
