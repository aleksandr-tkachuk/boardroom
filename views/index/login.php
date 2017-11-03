
<div class="container-fluid" style='text-align: center'>
<h1>Boardroom Booker</h1>
<p>Authorization</p>
</div>
<!--    <form action="index.php?c=index&a=auth" method="POST">
<div style="color: red">
<!?echo $_SESSION["authError"]?>
</div>
<div class="loginPoint">
Login:
<input type="login" name="login" value="">
</div>
<div class="loginPoint">
Password:
<input type="password" name="password">
</div>
<div class="loginInput">
<input type="submit" name="loginSubmit">
</div>
</form>-->
<div class="wrapper">
<form  action="index.php?c=index&a=auth" method="POST" class="form-signin">
<div style="color: red">
 <?echo $_SESSION["authError"]?>
</div>
<h2 class="form-signin-heading">Please login</h2>
<input type="text" class="form-control" name="login" placeholder="Email Address" required="" autofocus="" />
<input type="password" class="form-control" name="password" placeholder="Password" required=""/>      
<label class="checkbox">
<input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
</label>
<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>   
</form>

