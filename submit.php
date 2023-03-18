<?php

use classes\products\Product;

require 'config/config.php';
require 'autoload.php';

if (isset($_POST['checked_products'])) {
  $db = new classes\Database();
  Product::setDatabase($db);
  Product::deleteCheckedProducts($_POST['checked_products']);
} else {
  //check it
  header("Location: {$_SERVER['HTTP_REFERER']}");
  exit;
}
