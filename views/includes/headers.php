<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Boardroom Booker</title>

    <!-- Bootstrap -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="./css/font-awesome.min.css" rel="stylesheet">
    <link href="./css/bootstrap-datetimepicker.css" rel="stylesheet">
    <link  href="./css/main.css" type="text/css" rel="stylesheet">
    <link href="./css/bootstrap-glyphicons.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.7/fonts/glyphicons-halflings-regular.woff" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.7/fonts/glyphicons-halflings-regular.ttf" rel="stylesheet">

   <!--<script  type="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.slim.js"></script>-->
   <script src="./js/jquery-3.2.1.min.js"></script>
</head>
<body>
<div class="container">
    <?php if (isset($_SESSION["auth"]) && $_SESSION["auth"]) { ?>
        <h4>Hello, <?php echo $_SESSION["authName"]; ?>
            <a href="index.php?c=index&a=logout" class="btn btn-default" style="color: #2aabd2">Logout</a>
        </h4>
    <?php } ?>
