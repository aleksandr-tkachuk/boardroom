
<div class="col-sm-12 img-rounded" style="background:url(images/backgroundBook.jpg) center no-repeat;
background-size:cover;">
    <h2 >Boardroom <?= $form["room"] ?></h2>
    <form action="index.php?c=bookit&a=index&room=<?= $form["room"] ?>" id="formCreate" method="post" class="form-horizontal">
        <div id="errors">
            <?

            if (sizeof($form["errors"]) > 0) {
                echo "<div class=\"alert alert-danger\" role=\"alert\">Errors:<br>";
                foreach ($form["errors"] as $error) {
                    echo $error, "<br>";
                }
                echo "</div>";
            } ?>
            <br>
        </div>
        <h3 class="text-success">New Event</h3>
        <p class="text-warning">1.Booked for:</p>
        <select name="user" data-style="btn-primary" class="form-control"  style="width: auto">
            <? if ($user->users_role == 1) {
                foreach ($users as $key => $value) { ?>
                    <option value="<?= $value['users_id'] ?>" <?= ($value["users_id"] == $form["user"]) ? "selected" : "" ?>><?= $value['users_name'] ?></option>
                <? }
            } else { ?>
                <option value="<?= $user->users_id ?>"><?= $user->users_name ?></option>
            <? } ?>
        </select><br><br>
        <p class="text-warning">2.I would like to book this meeting:</p>
<!--        <input type=date min=--><?//= $form["date"] ?><!-- name="date" value="--><?//= $form["date"] ?><!--"><br>-->
        <input type=hidden name="date" value="">
        <div class='input-group date' id='date' style="width: 150px;">
            <input type='text' class="form-control" />
            <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
        </div>
        <p class="text-warning">3.Specify what the time and of the meeting(This will be what peopel see on the calendar.) </p>
        <label>Start: </label>
<!--        <input type=time step=1800 name="start" value="--><?//= $form["start"] ?><!--">-->
        <input type=hidden name="start" value="">
        <div class='input-group date' id='start' style="width: 150px;">
            <input type='text' class="form-control" />
            <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
        </div>
        - 30m
        increments<br>
        <label>End: </label>
<!--        <input type=time step=1800 name="end" value="--><?//= $form["end"] ?><!--">-->
        <input type=hidden name="end" value="">
        <div class='input-group date' id='end' style="width: 150px;">
            <input type='text' class="form-control" />
            <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
        </div>
        - 30m increments<br>
        <p class="text-warning">4.Enter the specifics for the meeting.(This will be peopel see when they click on an event link.)</p>
        <textarea name="description" class="form-control" style="width: auto"><?= $form["description"] ?></textarea><br>
        <p class="text-warning"> to be a recurring event?</p>

        <input type="radio" class="recuringNo" name="recurring" <?= ($form["recurring"] == 0) ? "checked" : "" ?>
               value="0"><label>no</label><br>
        <input type="radio" name="recurring" class="recuringYes" <?= ($form["recurring"] == 1) ? "checked" : "" ?>
               value="1"><label>yes</label><br>

        <div class="recuringContent">
            <p class="text-warning">.</p>
            <input type="radio" name="specify" <?= ($form["specify"] == 1) ? "checked" : "" ?>
                   value="1"><label>weekly</label><br>
            <input type="radio" name="specify" <?= ($form["specify"] == 2) ? "checked" : "" ?>
                   value="2"><label>bi-weekly</label><br>
            <input type="radio" name="specify" <?= ($form["specify"] == 3) ? "checked" : "" ?>
                   value="3"><label>monthly</label><br>
            <p class="text-success">If weekly,or bi-weekly,specify the number of weeks for it to keep recurring.</p>
            <p class="text-success">If monthly, specify,the number of months.(If you choose "bi-weekly" and put in an add number of weeks, the computer will round down.)</p>
            <input type="number" name="duration" value="<?= $form["duration"] ?>" max="4" min="0"><label>duration(max: 4
                weeks, 2 bi-weeks, 1 monthly)</label><br>
            <br><br>
        </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Add event</button>
                <a href="index.php?room=<?= $form["room"] ?>" class="btn btn-primary">
                    <span class="glyphicon "></span>&laquo; Back
                </a
            </div>
    </form>
    <br><br>
</div>

<script>
    $(document).ready(function () {
        $('.recuringNo, .recuringYes').change(function(){
            //поля  для заполнения рекурсии при условии её необходимости
            var recuringResult = $('.recuringNo:checked, .recuringYes:checked').val();
            if(recuringResult == 1){
                $('.recuringContent').fadeIn('fast');
            }else{
                $('.recuringContent').fadeOut('fast');
            }
        });
        $('#date').datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: '<?=$dateStartNow?>',
            minDate: '<?=$dateStartNow?>',
        });

        $('#start').datetimepicker({
            format: '<?=($timeFormat == 12) ? 'hh:mm a' : 'HH:mm'?>',
            stepping: 30,
            defaultDate: '<?=$dateStartNow?>',
            disabledTimeIntervals: [
                [moment().hour(0).minutes(0), moment().hour(7).minutes(59)],
                [moment().hour(19).minutes(30), moment().hour(24).minutes(0)]
            ]
        }).on('dp.change',function(event){
            var minTime = new Date(event.date.valueOf());
            minTime.setMinutes(minTime.getMinutes() + 30);
            $('#end').data("DateTimePicker").minDate(minTime).defaultDate(minTime);
        });

        $('#end').datetimepicker({
            format: '<?=($timeFormat == 12) ? 'hh:mm a' : 'HH:mm'?>',
            stepping: 30,
            defaultDate: '<?=$dateEndNow?>',
            disabledTimeIntervals: [
                [moment().hour(0).minutes(0), moment().hour(7).minutes(59)],
                [moment().hour(20).minutes(1), moment().hour(24).minutes(0)]
            ]
        }).on('dp.show',function(event){
            var minTime = new Date($("#start").data("DateTimePicker").date());
            minTime.setMinutes(minTime.getMinutes() + 30);
            $('#end').data("DateTimePicker").minDate(minTime).defaultDate(minTime);
        });

        $("#formCreate").on("submit", function(){
            $("input[name=date]").val($("#date").data("DateTimePicker").date().get().format("YYYY-MM-DD"));
            $("input[name=start]").val($("#start").data("DateTimePicker").date().get().format("HH:mm"));
            $("input[name=end]").val($("#end").data("DateTimePicker").date().get().format("HH:mm"));
        });

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
            //console.log(maxValue);
            $('input[name="duration"]').get(0).max = maxValue
        });
    });
</script>

