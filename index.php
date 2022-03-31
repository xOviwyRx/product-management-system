<?php

$title = "Product List";
$form_id = "list_form";


require_once './header.php';
 
    if (isset($_POST['delete'])){
                if (!empty($_POST['checked_products'])){
                    foreach ($_POST['checked_products'] as $product_id){
                        classes\Product::deleteProductById($db, $product_id);
                    }
                    header("Location: index.php");
                }
            }
?>
                  <button class="mr-4 btn btn-outline-dark" onclick="window.location.href='addProduct.php'" class="mr-4">ADD</button>
                  <button class="mr-4 btn btn-outline-dark mr-4" form = "list_form" type="submit" name="delete" id="delete-product-btn" class="mr-3">MASS DELETE</button>
                </div>
            </div>
            <hr>
            <div>
            <form method = "post" action="" class="ml-3" id = "list_form">
                <div class="container-fluid">
                    <div class="row"> 
            <?php
            //*Filling array products from the database*//

            $products = classes\Product::getAllProductsFromDB($db);
            $checked_records = array();
          
            for ($i = 0; $i < sizeof($products); $i++){          
                $product = $products[$i];
                ?>
                 <label for='product<?php echo $i."_input_checkbox" ?>'>
                    <div class="mr-5 mt-3 border border-dark mb-4 p-3 pb-5" style="width: 230px">
                        <input name="checked_products[]" type="checkbox" class="delete-checkbox"
                               value='<?php echo $product->getProductId()?>'
                               id='product<?php echo $i."_input_checkbox" ?>'/>
                        <p class="text-center m-0"><?php print $product->getSku() ?></p>
                        <p class="text-center m-0"><?php print $product->getName() ?></p>
                        <p class="text-center m-0"><?php print $product->getPrice()?> $</p>
                        <p class="text-center m-0"><?php print $product->getSpecificAttributes() ?></p>
                    </div>
                 </label>
                <?php  
            }
            ?>
                    </div>
                </div>
            </form>
            
            </div>
            </section>
       <?php 
        include "./footer.html";
        ?>    
    </div>
 </body>
</html>
