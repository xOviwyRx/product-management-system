<?php

use classes\products\Product;
use classes\Page;

require '../app/initialize.php';

$page = new Page("Product List");
?>

<?php include PARTIALS . 'header.php'; ?>

<!-- use vue lists -->
<!-- btn group using??? -->
<div class="min-vh-100 d-flex flex-column px-5 pt-5" id="app">
    <div class="d-flex justify-content-between px-3">
        <p class="h2 fw-bold"><?= $page->getTitle() ?></p>
        <div class="buttons">
            <button class="me-5 btn btn-outline-dark" 
                name="ADD" value="ADD" type="button" 
                onclick="window.location.href='addProduct/'">
                ADD
            </button>
            <button class="me-4 btn btn-outline-dark" form="list_form" 
                type="submit" name="delete" id="delete-product-btn">
                MASS DELETE
            </button>
        </div>
    </div>
    <!-- use sass here -->
    <hr>

    <div class="mt-4">
        <form method="post" action="submit.php" id="list_form">
                <div class="row mx-auto row-cols-xl-4 row-cols-lg-3 row-cols-md-2">
                    <?php
                    $products = Product::all();
                    $checked_records = array();
                    for ($i = 0; $i < sizeof($products); $i++) :
                        $product = $products[$i];
                    ?>
                    <div class="col">  
                        <label for="product<?= "{$i}_input_checkbox" ?>">
                            <div class="border border-dark border-3 mb-5 p-3 pb-5 product-box">
                                <input name="checked_products[]"
                                       type="checkbox"
                                       class="delete-checkbox"
                                       value="<?= $product->getProductId() ?>"
                                       id="product<?= "{$i}_input_checkbox" ?>"
                                />
                                <p class="text-center m-0"><?= $product->getSku() ?></p>
                                <p class="text-center m-0"><?= $product->getName() ?></p>
                                <p class="text-center m-0"><?= $product->getPrice() ?></p>
                                <p class="text-center m-0"><?= $product->getSpecificAttributes() ?></p>
                            </div>
                        </label>
                    </div>
                    <?php endfor; ?>
            </div>
        </form>
    </div>

    <?php include PARTIALS . "footer.php"; ?>