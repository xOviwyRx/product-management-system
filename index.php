<?php
  $title = "Product List";
  require 'header.php';
?>

                    <button class="mr-5 btn btn-outline-dark" name="ADD" value="ADD" type="button" onclick="window.location.href='/addProduct/'"> ADD
                    </button>
                    <button class="mr-4 btn btn-outline-dark" form = "list_form" type="submit" name="delete" id="delete-product-btn">MASS DELETE</button>
                </div>
            </div>
            <hr>


            <form method = "post" action="submit.php" class="ml-3" id = "list_form">
                <div class="container-fluid">
                    <div class="row">
            <?php
            //*Filling array products from the database*//

            $products = classes\Product::getAllProductsFromDB($db);
            $checked_records = array();

            for ($i = 0; $i < sizeof($products); $i++):
                $product = $products[$i];
                ?>
                 <label for='product<?="${i}_input_checkbox"?>'>
                    <div class="mr-5 mt-3 border border-dark mb-4 p-3 pb-5 product-box">
                        <input name="checked_products[]" type="checkbox" class="delete-checkbox"
                               value='<?=$product->getProductId()?>'
                               id='product<?="${i}_input_checkbox"?>'/>
                        <p class="text-center m-0"><?=$product->getSku()?></p>
                        <p class="text-center m-0"><?=$product->getName()?></p>
                        <p class="text-center m-0"><?=$product->getPrice()?> $</p>
                        <p class="text-center m-0"><?=$product->getSpecificAttributes()?></p>
                    </div>
                 </label>
                <?php
            endfor;
            ?>
                    </div>
                </div>
            </form>

            </section>
       <?php
        include "./footer.html";
        ?>

 </body>
 <script src="js/main.js"></script>
</html>
