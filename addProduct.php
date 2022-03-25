<?php
$title = "Product Add";
require './libraries/Button.php';
$form_id = "product_form";
require_once './header.php';
?>
            
                    <button class="mr-4 btn btn-outline-dark" form = "product_form" type="submit" name="save" class="mr-3">Save</button>
                    <button class="mr-4 btn btn-outline-dark" onclick="window.location.href='index.php'" class="mr-2">Cancel</button>
                </div> 
            </div>
            <hr>
            
            <form style="width:500px" method = "post" action="" id = "product_form">
                <div class="row mb-3">
                    <label class="col-form-label col-sm-3" for="sku">SKU</label>
                    <div class="col-sm-9">
                        <input class="form-control" name="sku" id="sku" required
                          oninvalid="this.setCustomValidity('Please, submit required data')"
                            oninput="this.setCustomValidity('')"/>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-form-label col-sm-3" for="name">Name</label>
                    <div class="col-sm-9">
                        <input name="name" class="form-control" id="name" required
                            oninvalid="this.setCustomValidity('Please, submit required data')"
                            oninput="this.setCustomValidity('')"/>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-form-label col-sm-3" for="price">Price ($)</label>
                    <div class="col-sm-9">
                        <input pattern="\d+(,\d{2})?" name="price" class="form-control" id="price" required
                            oninvalid="this.setCustomValidity('Please, submit required data')"
                            oninput="this.setCustomValidity('')"/>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-form-label col-sm-4" for="typeswitcher" id="typeswitcher">Type Switcher</label>
                    <div class="col-sm-3 select_box">
                        <select class="form-control" name = "typeswitcher" id="productType">
                            <option value = "DVD" id="DVD" selected>DVD</option>
                            <option value = "Book" id="Book">Book</option>
                            <option value = "Furniture" id="Furniture">Furniture</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3" id ="noDVD">
                    <label class="col-form-label col-sm-3" for="size">Size (MB)</label>
                    <div class="col-sm-9">
                        <input class="form-control" name="size" id="size" required
                            oninvalid="this.setCustomValidity('Please, submit required data')"
                            oninput="this.setCustomValidity('')">
                        <p class="mt-3">Please, provide size</p>
                    </div>
                </div>
                <div class="row mb-3" id="noBook">
                    <label class="col-form-label col-sm-3" for="weight">Weight (KG)</label>
                    <div class="col-sm-9">    
                        <input class="form-control" name="weight" id="weight"
                            oninvalid="this.setCustomValidity('Please, submit required data')"
                            oninput="this.setCustomValidity('')">
                        <p class="mt-3">Please, provide weight</p>
                    </div>
                </div>
                <div id="noFurniture">
                    <div class="row mb-3">
                        <label class="col-form-label col-sm-3" for="height">Height (CM)</label>
                        <div class="col-sm-9">
                            <input class="form-control" name="height" id ="height"
                                 oninvalid="this.setCustomValidity('Please, submit required data')"
                                 oninput="this.setCustomValidity('')">
                        
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-form-label col-sm-3" for="width">Width (CM)</label>
                        <div class="col-sm-9">
                            <input class="form-control" name="width" id ="width"
                                   oninvalid="this.setCustomValidity('Please, submit required data')"
                                   oninput="this.setCustomValidity('')">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-form-label col-sm-3" for="length">Length (CM)</label>
                        <div class="col-sm-9">
                            <input class="form-control" name="length" id ="length"
                                   oninvalid="this.setCustomValidity('Please, submit required data')"
                                    oninput="this.setCustomValidity('')">
                            <p class="mt-3">Please, provide dimensions</p>
                        </div>
                        
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
       <script src="js/main.js"></script>
       
       
</script>
    </body>
    
</html>
