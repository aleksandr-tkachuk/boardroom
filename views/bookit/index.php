<h2>Boardroom Booker</h2>
<form action="" method="post">
    1.Booked for:<br>
    <select name="user">
        <? if($user->users_name == 'Admin'){
        foreach ($users as $key => $value) {?>
            <option value=""><?=$value['users_name'] ?></option>
        <? } }
        else {?>
        <option value=""><?=$user->users_name ?></option>
        <? } ?>
    </select><br><br>
    2.I would like to book this meeting:<br>
    <input type=date step=7 min=2017-09-08> - Monday only<br>
    <input type=time min=8:00 max=17:00 step=1800> - 30m increments<br>
    <label>Start Date:(dd/mm/yyyy) <input type="text" size="12" required pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="dd/mm/yyyy" name="startdate"></label><br>
    <label>Start Time: <input type="text" size="12" pattern="\d{1,2}:\d{2}([ap]m)?" name="starttime"></label><br>
    <input type="datetime-local" name="xyz" value="<?php echo date("Y-m-d\TH:i:s",time()); ?>"/>
    <p><input type="submit"></p>
</form>
<?php

