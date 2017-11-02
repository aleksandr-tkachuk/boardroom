
<?php foreach ($users as $value) { ?>
    <a href="" ><?=$value['users_name']?></a>
    <a href="index.php?c=employeelist&a=remove&users_id=<?=$value['users_id'];?>" >remove</a>
    <a href="index.php?c=employeelist&a=update&users_id=<?=$value['users_id'];?>" >edit</a><br>
<? } ?>
<a href="index.php?c=employeelist&a=create" >Add a new employee</a><br>


