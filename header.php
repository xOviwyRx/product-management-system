<!DOCTYPE html>
<?php 
include_once 'config/config.php';
require_once 'classes/autoload.php';

$db = new classes\Database();
if (!(empty($db->error))){
    echo $db->error;
    exit();
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title ?></title>
        <link rel="stylesheet" type="text/css" href="/css/library/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/css/main.css" />
        <script src="/js/library/bootstrap.min.js"></script>
        <script
			  src="https://code.jquery.com/jquery-3.6.0.js"
			  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
			  crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="flex-column container-fluid d-flex pt-5 pl-5 pr-5 min-vh-100">
          <section>
            <div class="d-flex justify-content-between pl-3 pr-3">
                <p class="h2 ml-2 font-weight-bold"><?php echo $title ?></p>
                <div class="align-self-center"> 

