<?php

$title = "Product List";
require './libraries/Button.php';
$buttons = array();
$buttons[] = new Button("ADD", "add", "");
$buttons[] = new Button("MASS DELETE", "delete", "delete-product-btn");
$form_id = "";
require_once './header.php';

// session_start();
?>
    

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
            <div>
                <input name="checked_products[]" type="checkbox" class=".delete-checkbox" value="<?php echo $product->getProductId()?>"/>
                <br/>
                <?php

    //            $product = new $row['type']();
    //            $product->setName($row['name']);
    //            $product->setSku($row['sku']);
    //            $product->setPrice($row['price']);



                print "SKU: ".$product->getSku()."\n";
                ?><br/>
                <?php
                echo "Name: ".$product->getName()."\n";
                ?>
                <br/>
                <?php
                echo "Price: ".$product->getPrice()." $\n";
                ?>
                <br/>
                <?php
                echo $product->getSpecificAttributes();
    //            foreach ($spec_attributes as $key => $value){
    //                echo $key.": ".$value;
    //            }
                }
                ?>

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
            elseif (isset($_POST['add'])){
                header("Location: addProduct.php");
            }
            include "./footer.html";
            ?>
    </div>
 </body>
</html>
