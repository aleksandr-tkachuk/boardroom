<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Boardroom Booker</title>

    <!-- Bootstrap -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/bootstrap-theme.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/main.css" type="text/css">
    <script src="./js/jquery-3.2.1.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>

</head>
<body>
<div class="container">
    <?php if (isset($_SESSION["auth"]) && $_SESSION["auth"]) { ?>
        <h4>Hello, <?php echo $_SESSION["authName"]; ?>
            <a href="index.php?c=index&a=logout" class="btn btn-default" style="color: #2aabd2">Logout</a>
        </h4>
    <?php } ?>
