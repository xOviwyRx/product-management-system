<?php


include 'config/config.php';
require_once './classes/autoload.php';



$db = new classes\Database();
classes\Product::deleteCheckedProducts($db, $_POST['checked_products']);
                