<?php
$title = "Product Add";
require './libraries/Button.php';
$form_id = "product_form";
require_once './header.php';
?>
            
                    <button form = "product_form" type="submit" name="save">Save</button>
                    <button onclick="window.location.href='index.php'">Cancel</button>
                </div>
                
            </div>
            <hr>
            <form style="width:500px" method = "post" action="" id = "product_form">
                <div class="row mb-3">
                    <label class="col-form-label col-sm-3" for="#sku">SKU</label>
                    <div class="col-sm-9">
                        <input class="form-control" name="sku" id="#sku" required
                          oninvalid="this.setCustomValidity('Please, submit required data')"
                            oninput="this.setCustomValidity('')"/>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-form-label col-sm-3" for="#name">Name</label>
                    <div class="col-sm-9">
                        <input name="name" class="form-control" id="#name" required
                            oninvalid="this.setCustomValidity('Please, submit required data')"
                            oninput="this.setCustomValidity('')"/>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-form-label col-sm-3" for="#price">Price ($)</label>
                    <div class="col-sm-9">
                        <input name="price" class="form-control" id="#price" required
                            oninvalid="this.setCustomValidity('Please, submit required data')"
                            oninput="this.setCustomValidity('')"/>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-form-label col-sm-3" for="typeswitcher">Type Switcher</label>
                    <div class="col-sm-3">
                        <select class="form-control" name = "typeswitcher" id="#productType">
                            <option value = "DVD" selected>DVD</option>
                            <option value = "Book">Book</option>
                            <option value = "Furniture">Furniture</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-form-label col-sm-3" for="size">Size (MB)</label>
                    <div class="col-sm-9">
                        <input class="form-control" name="size" id="#size"/>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-form-label col-sm-3" for="weight">Weight (KG)</label>
                    <div class="col-sm-9">    
                        <input class="form-control" name="weight" id="#weight">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-form-label col-sm-3" for="height">Height (CM)</label>
                    <div class="col-sm-9">
                        <input class="form-control" name="height" id ="#height">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-form-label col-sm-3" for="width">Width (CM)</label>
                    <div class="col-sm-9">
                        <input class="form-control" name="width" id ="#width">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-form-label col-sm-3" for="length">Length (CM)</label>
                    <div class="col-sm-9">
                        <input class="form-control" name="length" id ="#length">
                    </div>
                </div>
        </form>
        <?php
        include "./footer.html";
        $typeswitcher = filter_input(INPUT_POST, 'typeswitcher');
        //$checked_products = filter_input(INPUT_POST, 'checked_products');
        //echo $checked_products[0];
        if (isset($_POST['save'])){
            $name = filter_input(INPUT_POST, 'name');
            $sku = filter_input(INPUT_POST, 'sku');
            $price = filter_input(INPUT_POST, 'price');
            $product = new $typeswitcher($name, $sku, $price);
            $product->setSpecificAttributes(filter_input_array(INPUT_POST));
            $product->addProductToDB();
        }
        ?>
       </div>   
    </body>
</html>
