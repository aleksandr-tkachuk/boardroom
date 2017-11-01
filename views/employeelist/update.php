
<h2>Edit User</h2>
<form action='index.php?c=employeelist&a=update' method='post'>
Edit:
<input type="text" name='user' value='<?=$user->users_name?>'> <br><br>
<input type='hidden' name='hidden' value='<?=$user->users_id?>'>
<input type='submit' name='submit'>

</form>

