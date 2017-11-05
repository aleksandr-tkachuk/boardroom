
<?php foreach ($users as $value) { ?>
    <a href="" ><?=$value['users_name']?></a>
  <!--<a href="index.php?c=employeelist&a=remove&users_id=<?/*=$value['users_id'];*/?>" >remove</a>-->
   <a href="index.php?c=employeelist&a=index&name=<?=$value['users_name'];?>" >remove</a>
    <a href="index.php?c=employeelist&a=update&users_id=<?=$value['users_id'];?>" >edit</a><br>
<? } ?>
<a href="index.php?c=employeelist&a=create" >Add a new employee</a><br>
<? if (isset($_GET['name'])) { ?>
<div class="modal in" style="display: block">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Are you sure you want to delete </h4>
            </div>
            <div class="modal-body">
                <h3><?=$_GET['name'];?></h3>
                <div class="row">
                    <div class="col-12-xs text-center">
                        <form method="post" action="index.php?c=employeelist&a=remove">
                            <button class="btn btn-success btn-md" >Yes</button>
                            <button class="btn btn-danger btn-md" >No</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<? } ?>

<table class="table table-striped table-bordered"
       id="bootstrap_git">
    <?php foreach ($users as $value) { ?>
    <thead>
    <tr>
        <th>Name</th>
        <th>Id</th>
        <th>Login</th>
        <th>Status</th>
        <th>Edit</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?=$value['users_name']?></td>
        <td><?=$value['users_id']?></td>
        <td><?=$value['users_login']?></td>
        <td><?=$value['users_role']?></td>
        <td>
            <button title="" type="button"
                    class="btn btn-danger remove show_tip"
                    data-original-title="Remove from list">
                <i class="fa fa-trash-o"></i>
            </button>
        </td>
    </tr>
    </tbody>
    <? } ?>
</table>

<script type='text/javascript'>
    $(window).load(function(){
        $(function () {
            $("table#bootstrap_git").on("click", ".remove", function () {
                $(this).closest('tr').remove();
            });
        });
        $(function () {
            $(".show_tip").tooltip({
                container: 'body'
            });
        });
        $(document).click(function () {
            $('.tooltip').remove();
            $('[title]').tooltip();
        });
    });
</script>

