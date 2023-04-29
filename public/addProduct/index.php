<?php
use classes\Page;

require '../../app/initialize.php';
$page = new Page("Product Add", "addProduct");

require PARTIALS . 'header.php';
?>

<!-- use vue lists -->
<div class="min-vh-100 d-flex flex-column px-5 pt-5" id="app">
    <div class="d-flex justify-content-between px-3">
        <p class="h2 fw-bold"><?= $page->getTitle() ?></p>
        <div class="buttons">
            <button class="me-5 btn btn-outline-dark" form="product_form" id="submit" type="submit" name="save" onclick="validate()">Save</button>
            <button class="mr-4 btn btn-outline-dark" onclick="window.location.href='../index.php'">Cancel</button>
        </div>
    </div>
<hr>

<form class="mt-4" method="post" action="submit.php" id="product_form">
    <div class="alert alert-danger display-error d-none" id="error-valid"></div>
    <div class="row mb-3">

        <label class="col-form-label col-sm-3" for="sku">SKU</label>
        <div class="col-sm-9">
            <!-- use vue v-model.trim -->
            <input class="form-control border-dark" name="sku" id="sku" required />
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-form-label col-sm-3" for="name">Name</label>
        <div class="col-sm-9">
            <input name="name" class="form-control border-dark" id="name" required />
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-form-label col-sm-3" for="price">Price ($)</label>
        <div class="col-sm-9">
            <input placeholder="0.00" name="price" class="form-control input_number border-dark" id="price" pattern="^[0-9]+(\.[0-9]{1,2})?$" required />
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-form-label col-sm-4" for="typeswitcher" id="typeswitcher">Type Switcher</label>
        <div class="col-sm-5 select_box">
            <!-- use vue v-model for select with v-for -->
            <select class="form-control border-dark" name="typeswitcher" id="productType">
                <option value="" disabled selected>Type Switcher</option>
                <option value="DVD">DVD</option>
                <option value="Book">Book</option>
                <option value="Furniture">Furniture</option>
            </select>
        </div>
    </div>
    <div class="row mb-3 d-none" id="dvd">
        <label class="col-form-label col-sm-3" for="size">Size (MB)</label>
        <div class="col-sm-9">
            <input placeholder="0.0" class="form-control border-dark" name="size" id="size" pattern="^[0-9]+(\.[0-9]{1})?$" required />
            <p class="mt-3">Please, provide size</p>
        </div>
    </div>
    <div class="row mb-3 d-none" id="book">
        <label class="col-form-label col-sm-3 pe-0" for="weight">Weight (KG)</label>
        <div class="col-sm-9">
            <input class="form-control border-dark" pattern="^[0-9]+(\.[0-9]{1})?$" placeholder="0.0" name="weight" id="weight" />
            <p class="mt-3">Please, provide weight</p>
        </div>
    </div>
    <div id="furniture" class="d-none">
        <div class="row mb-3">
            <label class="col-form-label col-sm-3 pe-0" for="height">Height (CM)</label>
            <div class="col-sm-9">
                <input class="form-control border-dark" pattern="^[0-9]+(\.[0-9]{1})?$" placeholder="0.0" name="height" id="height" />
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-form-label col-sm-3" for="width">Width (CM)</label>
            <div class="col-sm-9">
                <input class="form-control border-dark" pattern="^[0-9]+(\.[0-9]{1})?$" placeholder="0.0" name="width" id="width" />
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-form-label col-sm-3" for="length">Length (CM)</label>
            <div class="col-sm-9">
                <input class="form-control border-dark" pattern="^[0-9]+(\.[0-9]{1})?$" name="length" id="length" placeholder="0.0" />
                <p class="mt-3">Please, provide dimensions</p>
            </div>

        </div>
    </div>
</form>
<?php include PARTIALS . "footer.php"; ?>