<!DOCTYPE html>
<html>
<head>
<title></title> 
<meta charset="utf-8">
<link href="style.css" type="text/css" rel="stylesheet">
</head>
<body>
<?php include(BASE_PASS . 'views/menu.php'); ?>

<a href='index.php?c=employeelist&a=create'>create<br>
<?php
foreach ($author as $value) {
    echo $value['users_name']."&nbsp;<a href='index.php?c=employeelist&a=update=&users_id="
        .$value['users_id']."'>change</a>&nbsp;"
        . "&nbsp;<a href='index.php?c=employeelist&a=delete&users_id="
        .$value['users_id']."'>delete</a>";
}
?>
</body>
</html>
