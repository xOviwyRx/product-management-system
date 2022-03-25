<?php

$title = "Product List";
require './libraries/Button.php';
$buttons = array();
$form_id = "list_form";

require_once './header.php';

// session_start();
?>
                  <button class="mr-4 btn btn-outline-dark" onclick="window.location.href='addProduct.php'" class="mr-4">ADD</button>
                  <button class="mr-4 btn btn-outline-dark" form = "list_form" type="submit" name="delete" id="delete-product-btn" class="mr-3">MASS DELETE</button>
                </div>
            </div>
            <hr>
            <form method = "post" action="" id = "list_form">
                <div class="container-fluid d-flex">
                    <div class="row justify-content-around">
            <?php
            //*Filling array products from the database*//

    //        $records = $db->select($db->getQueryAllRecords());
    //        $products = array();
    //        foreach ($records as $row){
    //           $name = $row['name'];
    //           $sku = $row['sku'];
    //           $price = $row['price'];
    //                
    //           $product = new $row['type']($name, $sku, $price);
    //           $product->setSpecificAttributes($row);
    //           $products[] = $product; 
            $products = Product::getAllProductsFromDB($db);
            $checked_records = array();
           
            foreach ($products as $product){
                ?>
                <div class="pl-4 pr-4 pt-2 pb-5 mr-5 mb-4 col-3 border border-dark">
                    <input name="checked_products[]" type="checkbox" class=".delete-checkbox" value="<?php echo $product->getProductId()?>"/>
                    <p class="text-center m-0"><?php print $product->getSku() ?></p>
                    <p class="text-center m-0"><?php print $product->getName() ?></p>
                    <p class="text-center m-0"><?php print $product->getPrice()?> $</p>
                    <p class="text-center m-0"><?php print $product->getSpecificAttributes() ?></p>

                </div>
                <?php
            }
            ?>
                </div>
                </div>
            </form>
            <?php
            if (isset($_POST['delete'])){
                if (!empty($_POST['checked_products'])){
                    foreach ($_POST['checked_products'] as $product_id){
                        Product::deleteProductById($db, $product_id);
                    }
                    header("Location: index.php?msg=".urlencode('Record(s) Deleted'));
                }
            }
            include "./footer.html";
            ?>
            
    </div>
 </body>
</html>
