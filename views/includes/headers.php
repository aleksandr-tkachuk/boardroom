<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Boardroom Booker</title>
    <link rel="stylesheet" href="./css/main.css" type="text/css" />
    <!-- Bootstrap -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/bootstrap.min" rel="stylesheet">
    <link href="./css/bootstrap-theme.min" rel="stylesheet">
    <link href=."/css/bootstrap-theme.min.css.map" rel="stylesheet">
    <script src="http://java2s.com/style/jquery-1.8.0.min.js"></script>
    <script src="http://java2s.com/style/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.css"></script>

</head>
<body>
<div id="wrapperDiv">
    <?php if(isset($_SESSION["auth"]) && $_SESSION["auth"]){?>
    <div id="hello">Hello, <?php echo $_SESSION["authName"];?>
        &nbsp;&nbsp;<a href="index.php?c=index&a=logout">Logout</a>
    </div>
<?php }?>
