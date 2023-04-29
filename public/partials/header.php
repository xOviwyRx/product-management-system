<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <?php $page = $page ?? new \classes\Page(); ?>
  <title><?= $page->getTitle(); ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="/public/assets/css/main.css" />
  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js"
          integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
          crossorigin="anonymous">
  </script>
  <script defer src="<?= $page->getJsMainPath()?>"></script>
</head>

<body>
  