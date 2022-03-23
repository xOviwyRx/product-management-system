<?php
$title = "Product Add";
require './libraries/Button.php';
$buttons = array();
$form_id = "product_form";
$buttons[] = new Button("Save", "save", "", $form_id, "submit");
$buttons[] = new Button("Cancel", "cancel", "", $form_id, "button");
require_once './header.php';
?>
    
            <div>
                <div>
                    <label for="sku">SKU:</label>
                    <input name="sku" id="#sku"/>
                </div>
                <div>
                    <label for="name">Name:</label>
                    <input name="name" id="#name"/>
                </div>
                <div>
                    <label for="price">Price</label>
                    <input name="price" id="#price"/>
                </div>
                <div>
                    <label for="typeswitcher">Type Switcher</label>
                    <select name = "typeswitcher" id="#productType">
                        <option value = "DVD" selected>DVD</option>
                        <option value = "Book">Book</option>
                        <option value = "Furniture">Furniture</option>
                    </select>
                </div>
                <div>
                    <label for="size">Size:</label>
                    <input name="size" id="#size"/>
                </div>
                <div>
                    <label for="weight">Weight</label>
                    <input name="weight" id="#weight">
                </div>
                <div>
                    <label for="height">Height</label>
                    <input name="height" id ="#height">
                </div>
                <div>
                    <label for="width">Width</label>
                    <input name="width" id ="#width">
                </div>
                <div>
                    <label for="length">Length</label>
                    <input name="length" id ="#length">
                </div>
            </div>
        </form>
        <button type="button">Some button</button>
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
        elseif (isset($_POST['cancel'])){
            header("Location: index.php");
        }
        ?>
          
    </body>
</html>
