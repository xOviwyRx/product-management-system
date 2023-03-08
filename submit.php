<?php

use classes\products\Product;

if (isset($_POST['checked_products'])) {
  require 'config/config.php';
  require 'autoload.php';
  $db = new classes\Database();
  Product::deleteCheckedProducts($db, $_POST['checked_products']);
} else {
  header("Location: {$_SERVER['HTTP_REFERER']}");
  exit;
}
