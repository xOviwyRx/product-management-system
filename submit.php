<?php
if (isset($_POST['checked_products'])){
  include 'config/config.php';
  require_once './classes/autoload.php';
  $db = new classes\Database();
  classes\Product::deleteCheckedProducts($db, $_POST['checked_products']);
} else {
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}
