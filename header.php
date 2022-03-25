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
        <!--<script src="js/library/bootstrap.min.js"></script>-->
<!--        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>-->

    </head>
    <body>
        <div class="container-fluid pt-5 pl-3">
            <div class="d-flex justify-content-between">
                <p class="h2 ml-2 font-weight-bold"><?php echo $title ?></p>
                <div class="align-self-center">
              <?php // foreach ($buttons as $button){ echo $button->showButton();}
                   ?>
            <!--  </div>
            <form method = "post" action="" id = "<?php // echo $form_id?>">
                

            
            
                <button onclick="window.location.href='addProduct.php'">ADD</button>

            <form method="POST">
                <input type="submit" value="ADD" onclick="document.location='addProduct.php'"/>
                <input type="submit" value="MASS DELETE" id="delete-product-btn"/>
            </form>  
         <hr>-->

