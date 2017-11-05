<h2>Add a new employee</h2>
<!--<form action = "index.php?c=employeelist&a=create" method = 'post'>
name<input type = 'text' name = 'name'><br><br>
login<input type = 'text' name = 'login'><br><br>
password<input type = 'text' name = 'password'><br><br>
role<input type = 'text' name = 'role'><br><br>
<input type = 'submit' name = 'submit' value = 'Add'>-->
    <br><br>
    <form action = "index.php?c=employeelist&a=create" method = 'post' class="form-horizontal">
        <div class="form-group">
            <label for="inputName"
                   class="col-lg-2 control-label col-sm-2 col-md-2 col-xs-2">Name</label>
            <div class="col-lg-3 col-sm-2 col-md-2 col-xs-2">
                <input type="text" class="form-control" maxlength="255"
                       required="required" name='name' placeholder="Name" />
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group">
            <label for="inputLogin" class="col-lg-2 control-label">Login</label>
            <div class="col-lg-3">
                <input type="text" class="form-control" required="required"
                       name='login' placeholder="Login">
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group">
            <label for="inputPassword" class="col-lg-2 control-label">Password</label>
            <div class="col-lg-3">
                <input type="text" class="form-control" required="required"
                       name='password' placeholder="password">
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group">
            <label for="inputRole" class="col-lg-2 control-label">Role</label>
            <div class="col-lg-3">
                <input type="text" class="form-control" required="required"
                       name='role' placeholder="Role">
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <button type="submit" name='submit' class="btn btn-default">Add</button>
            </div>
        </div>
    </form>


