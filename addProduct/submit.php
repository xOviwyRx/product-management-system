<?php
//1. Consider about DOCUMENT_ROOT? 
//2. Add check for isset post parameter
use classes\products\Product;

require '../config/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/autoload.php';
$db = new classes\Database();
Product::saveProduct($db, filter_input_array(INPUT_POST));
