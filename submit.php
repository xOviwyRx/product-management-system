<?php
include 'config/config.php';
require_once './classes/autoload.php';



$db = new classes\Database();
if (isset($_POST['delete'])){
                if (!empty($_POST['checked_products'])){
                    foreach ($_POST['checked_products'] as $product_id){
                        classes\Product::deleteProductById($db, $product_id);
                    }
                    header("Location: index.php");
                }
            }