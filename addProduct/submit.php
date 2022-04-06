<?php
include '../config/config.php';
require_once '../classes/autoload.php';



$db = new classes\Database();


$typeswitcher = filter_input(INPUT_POST, 'typeswitcher');
if (!empty($typeswitcher)){
    $name = filter_input(INPUT_POST, 'name');
    $sku = filter_input(INPUT_POST, 'sku');
    $price = filter_input(INPUT_POST, 'price');
    $type = "classes\\".$typeswitcher;
    try
    {
        $product = new $type($name, $sku, $price);
        $product->setSpecificAttributes(filter_input_array(INPUT_POST));
        $product->addProductToDB($db, $type);
        echo json_encode(['code'=>'200', 'msg'=>'success']);
    }
    catch(\Exception $e){
        echo json_encode(['code'=>'404', 'msg'=>$e->getMessage()]);
    }
}
else{
   echo json_encode(['code'=>'404', 'msg'=>'Please, submit required data']); 
}

 