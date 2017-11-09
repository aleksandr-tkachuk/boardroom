<h2>Boardroom Booker</h2>
    <form action="index.php?c=bookit&a=update&id=<?= $form["id"] ?>&room=<?= $form["room"] ?>" method="post">
        <input type="hidden" name="id" value="<?= $form["id"] ?>">
        <div id="errors">
            <? if (sizeof($form["errors"]) > 0) {
                echo "Errors:<br>";
                foreach ($form["errors"] as $error) {
                    echo $error, "<br>";
                }
            } ?>
            <br>
        </div>
        <h3>Update Event</h3>
        <p class="text-primary">1.Booked for:</p>
        <select name="user">
            <? if ($user->users_name == 'Admin') {
                foreach ($users as $key => $value) { ?>
                    <option value="<?= $value['users_id'] ?>" <?= ($value["users_id"] == $form["user"]) ? "selected" : "" ?>><?= $value['users_name'] ?></option>
                <? }
            } else { ?>
                <option value="<?= $user->users_id ?>"><?= $user->users_name ?></option>
            <? } ?>
        </select><br><br>
        2.I would like to book this meeting:<br>
        <input type=date min=<?= date("Y-m-d", strtotime("now")) ?> name="date" value="<?= $form["date"] ?>"><br>
        3.Specify what the time and of the meeting(This will be what peopel see on the calendar.) <br>
        <label>Start: </label><input type=time step=1800 name="start" value="<?= $form["start"] ?>"> - 30m
        increments<br>
        <label>End: </label><input type=time step=1800 name="end" value="<?= $form["end"] ?>"> - 30m increments<br>
        4.Enter the specifics for the meeting.(This will be peopel see when they click on an event link.)<br>
        <textarea name="description"><?= $form["description"] ?></textarea><br>
        5.Is this going to be a recurring event?<br>
        <input type="radio" name="recurring" <?= ($form["recurring"] == 0) ? "checked" : "" ?>
               value="0"><label>no</label><br>
        <input type="radio" name="recurring" <?= ($form["recurring"] == 1) ? "checked" : "" ?>
               value="1"><label>yes</label><br>
        6.If it is recurring, specify weekly, bi-weekly,or monthly.<br>
        <input type="radio" name="specify" <?= ($form["specify"] == 1) ? "checked" : "" ?>
               value="1"><label>weekly</label><br>
        <input type="radio" name="specify" <?= ($form["specify"] == 2) ? "checked" : "" ?>
               value="2"><label>bi-weekly</label><br>
        <input type="radio" name="specify" <?= ($form["specify"] == 3) ? "checked" : "" ?>
               value="3"><label>monthly</label><br>
        If weekly,or bi-weekly,specify the number of weeks for it to keep recurring. If monthly, specify,
        the number of months.(If you choose "bi-weekly" and put in an add number of weeks, the computer will round
        down.)<br>
        <input type="number" name="duration" value="<?= $form["duration"] ?>" max="4" min="0"><label>duration(max: 4
            weeks, 2 bi-weeks, 1 monthly)</label><br>
        <br><br>
        <? if ($form["recurring"] == 1) { ?>
            <input type="checkbox" name="btnApplyAll"><label>Apply to all occurrences?</label>
        <? } ?>
        <p><input type="submit"></p>
    </form>
<script>
    $(document).ready(function () {
        $('input[type=radio][name=specify]').change(function (e) {
            $('input[name="duration"]').val('0');
            var maxValue;
            switch (+e.target.value) {
                case 1:
                    maxValue = 4;
                    break;
                case 2:
                    maxValue = 2;
                    break;
                case 3:
                    maxValue = 1;
                    break;
            }
            console.log(maxValue);
            $('input[name="duration"]').get(0).max = maxValue
        });
    });
</script>

