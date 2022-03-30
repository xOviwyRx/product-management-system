<?php
//session_start();
include 'config/config.php';
include 'libraries/Database.php';
require './libraries/Product.php';
require './libraries/DVD.php';
require './libraries/Book.php';
require './libraries/Furniture.php';
        
//        echo $_POST['typeswitcher'];
//        echo json_encode(['code'=>200, 'msg'=>$_POST['typeswitcher']]);
        $typeswitcher = filter_input(INPUT_POST, 'typeswitcher');
//        echo 'something wrong';
//        //$checked_products = filter_input(INPUT_POST, 'checked_products');
//        //echo $checked_products[0];
////        if (isset($_POST['save'])){
            $name = filter_input(INPUT_POST, 'name');
            $sku = filter_input(INPUT_POST, 'sku');
            $price = filter_input(INPUT_POST, 'price');
            try
            {
                $product = new $typeswitcher($name, $sku, $price);
                $product->setSpecificAttributes(filter_input_array(INPUT_POST));
                $product->addProductToDB();
                echo json_encode(['code'=>'200', 'msg'=>'success']);
            }
            catch(Exception $e){
                echo json_encode(['code'=>'404', 'msg'=>$e->getMessage()]);
            }
//        }

//$typeswitcher = filter_input(INPUT_POST, 'typeswitcher');
////$checked_products = filter_input(INPUT_POST, 'checked_products');
////echo $checked_products[0];
//if (!is_null($typeswitcher)){
//    $name = filter_input(INPUT_POST, 'name');
//    $sku = filter_input(INPUT_POST, 'sku');
//    $price = filter_input(INPUT_POST, 'price');
//    $product = new $typeswitcher($name, $sku, $price);
//    $product->setSpecificAttributes(filter_input_array(INPUT_POST));
//    $product->addProductToDB();
//}

//else{
//    foreach ($checked_products as $value){
//                    echo "value:".$value.'<br/>';
//                }
//               echo 'ok';
//}
//$product->setName($name);
//$product->setSku($SKU);
//
//$product->setPrice($price);

//$array = filter_input(INPUT_POST);
//echo $array;
//$typeswitcher = filter_input(INPUT_POST, 'typeswitcher');

//$product = call_user_func($typeswitcher);
//echo $product;
//$additional_properties = array();
//switch ($typeswitcher){
//   case 'Book':
//       $weight = filter_input(INPUT_POST, 'Weight');
//       $product = new Book();
//       $product->setWeight($weight);
//       echo 'Book';
//       break;
//   case 'Furniture':
//       $width = filter_input(INPUT_POST, 'Width');
//       $height = filter_input(INPUT_POST, 'Height');
//       $length = filter_input(INPUT_POST, 'Length');
//       $product = new Furniture();
//       $product->setHeight($height);
//       $product->setLength($length);
//       $product->setWidth($width);
//       echo 'Furniture';
//       break;
//   default:
//       $size = filter_input(INPUT_POST, 'Size');
//       $product = new DVDDisk();
//       $product->setSize($size);
//   }
//$product->setSku($SKU);
//echo $product->getSku();
//$product->setName($name);
//$product->setPrice($price);
//$product->setAdditionalProperties();
//$product->insertRecord();
?>
