<div style="margin-left: 18%">
<h2>Add a new employee</h2>
</div>
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
        <div class="form-group" >
            <label class="col-lg-2 control-label">Admin</label>
            <div class="col-lg-3">
                <input type="radio" name='role' value="0">
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group checked">
            <label class="col-lg-2 control-label">User</label>
            <div class="col-lg-3">
                <input type="radio" name='role' value="1" checked>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <button type="submit" name='submit' class="btn btn-default" style="color: #2aabd2">Add</button>
                <a href="index.php?c=employeelist&a=index" class="btn btn-lg btn">
                    <span class="glyphicon "></span>&laquo;Back
                </a
            </div>
        </div>
    </form>



