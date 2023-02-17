<?php
  include '../config/config.php';
  require_once '../classes/autoload.php';
  $db = new classes\Database();
  classes\Product::saveProduct($db, filter_input_array(INPUT_POST));
