<?php
  include '../config/config.php';
  require_once $_SERVER['DOCUMENT_ROOT'].'/autoload.php';
  $db = new classes\Database();
  classes\Product::saveProduct($db, filter_input_array(INPUT_POST));
