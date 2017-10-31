<!DOCTYPE html>
<html>
<head>
<title> </title>
<meta charset="utf-8">
<link href="style.css" type="text/css" rel="stylesheet">
</head>
<body>
<?php include(BASE_PASS . 'views/menu.php'); ?>
<h2>Edit User</h2>
<form action='index.php?c=employeelist&a=update' method='post'>
Edit:
<input type="text" name='user' value='<?=$users["users_name"]?>'> <br><br>
<input type='hidden' name='hidden' value='<?=$users["users_id"]?>'>
<input type='submit' name='submit'>

</form>
</body>
</html>
