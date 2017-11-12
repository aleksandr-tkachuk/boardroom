<style>
    .recuringContent{
             display: none;
         }
</style>
<div class="col-sm-12 img-rounded" style="background:url(images/backgroundBook.jpg) center no-repeat;
background-size:cover;">
<h2>Boardroom <?= $form["room"] ?></h2>
    <form action="index.php?c=bookit&a=update&id=<?= $form["id"] ?>&room=<?= $form["room"] ?>" id="formCreate" method="post" class="form-horizontal">
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
        <h3 class="text-success">Update Event</h3>
        <p class="text-primary">1.Booked for:</p>
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
       <!-- <input type=date min=<?/*= date("Y-m-d", strtotime("now")) */?> name="date" value="<?/*= $form["date"] */?>"><br>-->
        <input type=hidden name="date" value="">
        <div class='input-group date' id='date' style="width: 150px;">
            <input type='text' class="form-control" />
            <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
        </div>
        <p class="text-warning">3.Specify what the time and of the meeting(This will be what peopel see on the calendar.) </p>
        <label>Start: </label>
        <!--<input type=time step=1800 name="start" value="<?/*= $form["start"] */?>">-->
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
        <!--<input type=time step=1800 name="end" value="<?/*= $form["end"] */?>">-->
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
        <input type=hidden name="recurring" id="recurring" value="">
        <? if ($form["recurring"] == 1) { ?>
            <input type="checkbox" name="btnApplyAll" class="recuringYes"><label>Apply to all occurrences?</label>
        <? } ?>
        <div class="recuringContent">
            5.If it is recurring, specify weekly, bi-weekly,or monthly.<br>
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
                weeks, 2 bi-weeks, 1 monthly)</label>
        </div>
        <br><br>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update event</button>
            <a href="index.php?room=<?= $form["room"] ?>" class="btn btn-primary">
                <span class="glyphicon "></span>&laquo; Back
            </a
        </div>
    </form>
<script>
    $(document).ready(function () {
        $('.recuringYes').change(function(){
            //поля  для заполнения рекурсии при условии её необходимости
            var recuringResult = $('.recuringYes:checked').val();
            console.log(recuringResult);
           if(recuringResult == 'on'){
               $('#recurring').val(1);
                $('.recuringContent').fadeIn('fast');
            }else{
               $('#recurring').val(0);
                $('.recuringContent').fadeOut('fast');
            }
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
            console.log(maxValue);
            $('input[name="duration"]').get(0).max = maxValue
        });

        $('#date').datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: '<?= $form["date"]?>',
        });

        $('#start').datetimepicker({
            format: '<?=($timeFormat == 12) ? 'hh:mm a' : 'HH:mm'?>',
            stepping: 30,
            defaultDate: '<?= $form["start"]?>',
            disabledTimeIntervals: [
                [moment().hour(0).minutes(0), moment().hour(7).minutes(59)],
                [moment().hour(20).minutes(1), moment().hour(24).minutes(0)]
            ]
        });

        $('#end').datetimepicker({
            format: '<?=($timeFormat == 12) ? 'hh:mm a' : 'HH:mm'?>',
            stepping: 30,
            defaultDate: '<?=$form["end"]?>',
            disabledTimeIntervals: [
                [moment().hour(0).minutes(0), moment().hour(7).minutes(59)],
                [moment().hour(20).minutes(1), moment().hour(24).minutes(0)]
            ]
        });

        $("#formCreate").on("submit", function(){
            var recuringResult = $('.recuringYes:checked').val();
            $("input[name=date]").val($("#date").data("DateTimePicker").date().get().format("YYYY-MM-DD"));
            $("input[name=start]").val($("#start").data("DateTimePicker").date().get().format("HH:mm"));
            $("input[name=end]").val($("#end").data("DateTimePicker").date().get().format("HH:mm"));
            $("input[name=recurring]").val((recuringResult == 'on')? '1' : 0);
        });
    });
</script>

