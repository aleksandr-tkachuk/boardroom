<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title></title>
    <link rel="stylesheet" href="/css/main.css" type="text/css" />
</head>
<body>
<div id="wrapperDiv">
    <?php if(isset($_SESSION["auth"]) && $_SESSION["auth"]){?>
    <div id="hello">Hello, <?php echo $_SESSION["authName"];?>
        &nbsp;&nbsp;<a href="index.php?c=index&a=logout">Logout</a>
    </div>
<?php }?>