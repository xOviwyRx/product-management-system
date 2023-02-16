<?php
  include '../config/config.php';
  require_once '../classes/autoload.php';
  $db = new classes\Database();
  $db->setPreparedStatement();
  classes\Product::saveProduct($db, filter_input_array(INPUT_POST));
