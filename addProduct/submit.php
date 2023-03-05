<?php
  require '../config/config.php';
  require $_SERVER['DOCUMENT_ROOT'] . '/autoload.php';
  $db = new classes\Database();
  classes\Product::saveProduct($db, filter_input_array(INPUT_POST));
