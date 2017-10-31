<div id="authorizationDiv">
    <div id="loginTitle">
        <p>Boardroom Booker</p>
        <p>Authorization</p>
    </div>
    <form action="index.php?c=index&a=auth" method="POST">
        <div style="color: red">
            <?echo $_SESSION["authError"]?>
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
    </form>
</div>