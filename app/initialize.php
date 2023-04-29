<?php

use classes\Database;
use classes\products\Product;

require_once 'config/config.php';
require_once 'autoload.php';
define("PARTIALS", dirname(__DIR__) . '/public/partials/');
$db = new Database();
Product::setDatabase($db);

