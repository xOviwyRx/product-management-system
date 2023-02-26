<?php
if (isset($_POST['checked_products'])){
  require 'config/config.php';
  require './classes/autoload.php';
  $db = new classes\Database();
  classes\Product::deleteCheckedProducts($db, $_POST['checked_products']);
} else {
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}
