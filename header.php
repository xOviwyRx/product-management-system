<!DOCTYPE html>
<?php include 'config/config.php'?>
<?php include 'libraries/Database.php';
require './libraries/Product.php';
require './libraries/DVD.php';
require './libraries/Book.php';
require './libraries/Furniture.php';

?>
<?php
    $db = new Database();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title ?></title>
        <link rel="stylesheet" type="text/css" href="css/library/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="css/main.css" />
        <script src="js/library/jquery-3.5.0.min.js"></script>
        <script src="js/library/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container-fluid pt-5 pl-3">
            <div class="d-flex justify-content-between">
                <p class="h2 font-weight-bold"><?php echo $title ?></p>
                <?php foreach ($buttons as $button){ echo $button->showButton();}
                   ?>
            </div>
            <form method = "post" action="" id = "<?php echo $form_id?>">
                

            
            
                <!--<button onclick="window.location.href='addProduct.php'">ADD</button>-->

    <!--        <form method="POST">
                <input type="submit" value="ADD" onclick="document.location='addProduct.php'"/>
                <input type="submit" value="MASS DELETE" id="delete-product-btn"/>
            </form>-->  
         <hr>

