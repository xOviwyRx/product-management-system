<?php

use classes\Page;
use classes\products\Product;

require '../app/initialize.php';

if (isset($_POST['checked_products'])) {
  Product::deleteCheckedProducts($_POST['checked_products']);
}

Page::redirectTo('/index.php');
