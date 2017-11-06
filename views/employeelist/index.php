
<br><a href="index.php?c=employeelist&a=create" class="btn btn-default" style="color: #4cae4c">Add a new employee</a><br><br>
<div id="myModal" class="modal in" style="display: none">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Are you sure you want to delete </h4>
            </div>
            <div class="modal-body">
               <h3 id="name"></h3>
                <div class="row">
                    <div class="col-12-xs text-center">
                            <button class="btn btn-success btn-md" id="yes">Yes</button>
                            <button class="btn btn-danger btn-md" id="no">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?/* } */?>

<table class="table table-striped table-bordered"
       id="myModal">
    <?php foreach ($users as $value) { ?>
    <thead>
    <tr>
        <th>Name</th>
        <th>Id</th>
        <th>Login</th>
        <th>Status</th>
        <th>Edit</th>
        <th>Remove</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?=$value['users_name']?></td>
        <td><?=$value['users_id']?></td>
        <td><?=$value['users_login']?></td>
        <td><?=$value['users_role']?></td>
        <td>
            <button type="button"
                    class="btnRemove btn btn-success remove show_tip"
                    data-original-title="Remove from list"
                    data-id="<?=$value['users_id']?>"
            </button>
        </td>
        <td>
            <button title="DELETE" type="button"
                    class="btnDelete btn btn-danger remove show_tip"
                    data-original-title="Remove from list"
                    data-id="<?=$value['users_id']?>"
                    data-name="<?=$value['users_name']?>">
            </button>
        </td>
    </tr>
    </tbody>
    <? } ?>
</table>

<script type='text/javascript'>
    $(".btnDelete").on("click", function() {
        var user_id = $(this).attr("data-id");
        var user_name = $(this).attr("data-name");
        console.log("open detail", user_id ,user_name);

        $("#myModal").modal("show");

        $("#name").text(user_name);
        $("#myModal").modal("show");
        $("#yes").attr("data-id", user_id);

        $("#yes").unbind("click").bind("click", function(){
            var user_id = $(this).attr("data-id");
            $(location).attr('href', 'index.php?c=employeelist&a=remove&users_id='+user_id);
        });
        $("#no").unbind("click").bind("click", function(){
            $(location).attr('href', 'index.php?c=employeelist&a=index');
        });
    });
    $(".btnRemove").unbind("click").bind("click", function(){
        var user_id = $(this).attr("data-id");
        $(location).attr('href', 'index.php?c=employeelist&a=update&users_id='+user_id);
    });

</script>


