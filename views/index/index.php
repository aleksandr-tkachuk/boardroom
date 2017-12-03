<div id="mainDiv" class="container">
    <div class="container navbar-brand" style="text-align: center; color: #2b669a ">
        Boardroom Booker
    </div>

    <!--  вывод ошибок -->

    <div>
        <? if ($eventCreateSuccess != "") { ?>
            <div class="alert alert-success" role="alert"><?= $eventCreateSuccess ?></div>
        <? } ?>
        <? if ($eventCreateError != "") { ?>
            <div class="alert alert-danger" role="alert"><?= $eventCreateError ?></div>
        <? } ?>
    </div>

    <div id="contentDiv">

        <!--  отрисака комнат -->

        <div class="btn-group btn-group-justified">
            <? foreach ($rooms as $room) { ?>
                <a href="index.php?room=<?= $room['rooms_id'] ?>"
                   class="btn btn-primary <?= ($room['rooms_id'] == $currentRoom) ? "active" : "" ?>"
                   style='width: 100%'><?= $room['rooms_name'] ?></a>&nbsp;&nbsp;
            <? } ?>
        </div>

        <!-- переключение месяца года -->

        <div class="row" style="margin: 1% 0">


            <div id="timeNavigationMenu" class="col-md-3">
                <a id="previousMonth" href="?c=index&a=index&room=<?= $currentRoom ?>&d=<?= $d ?>&go=prev"
                   class="btn btn-default"><</a>
                <label><?= $currMonth ?>
                    <?= $currYear ?></label>
                <a id="nextMonth" href="?c=index&a=index&room=<?= $currentRoom ?>&d=<?= $d ?>&go=next"
                   class="btn btn-default">></a>
            </div>

            <!--старт календаря понедельник,воскресенье-->

            <div data-toggle="buttons" class="btn-toolbar col-md-1">
                <button type="button" class="btn btn-info " id="format"
                        value="<?= ($options == 'mo') ? 'su' : 'mo' ?>"><?= ($options == 'su') ? 'SU' : 'MO' ?></button>
            </div>

            <div class="btn-toolbar" data-toggle="buttons">
                <!--переключение режима времени-->

                <label class="btn btn-info <?= ($timeFormat == 12) ? "active" : "" ?> ">
                    <input type="radio" name="options" value="12"
                           autocomplete="off" <?= ($timeFormat == 12) ? "checked" : "" ?>>12h
                </label>
                <label class="btn btn-info <?= ($timeFormat == 24) ? "active" : "" ?>">
                    <input type="radio" name="options" value="24"
                           autocomplete="off" <?= ($timeFormat == 24) ? "checked" : "" ?>>24h
                </label>
            </div>

        </div>
        <div id="calendarDiv">

            <!-- calendar -->

            <table class="table table-bordered">
                <?
                if ($options == 'su') {
                    $firstday = 'Monday';
                    $start = 1;
                    $a = 8;
                    $b = 15;
                    $c = 22;
                    $d = 29;
                    $j = 36;
                } elseif ($options == 'mo') {
                    $firstday = 'Sunday';
                    $start = 0;
                    $a = 7;
                    $b = 14;
                    $c = 21;
                    $d = 28;
                    $j = 35;
                } ?>
                <tr>
                    <th><?= $firstday ?></th>
                    <th><?= ($firstday == 'Sunday') ? 'Monday' : 'Tuesday' ?></th>
                    <th><?= ($firstday == 'Sunday') ? 'Tuesday' : 'Wednesday' ?></th>
                    <th><?= ($firstday == 'Sunday') ? 'Wednesday' : 'Thursday' ?></th>
                    <th><?= ($firstday == 'Sunday') ? 'Thursday' : 'Friday' ?></th>
                    <th><?= ($firstday == 'Sunday') ? 'Friday' : 'Saturday' ?></th>
                    <th><?= ($firstday == 'Sunday') ? 'Saturday' : 'Sunday' ?></th>
                </tr>
                <tr>

                    <?
                    $i = 1;
                    while ($start < $allDays + $firstDay){
                    if ($start == $a || $start == $b || $start == $c || $start == $d || $start == $j){
                    ?>
                </tr>
                <tr>
                    <?
                    }
                    if ($start < $firstDay) {
                        ?>
                        <td>&nbsp;</td>
                        <?
                    } else {
                        ?>
                        <!-- отрисовка события в календаре -->
                        <td>
                            <?= $i ?><br>
                            <?
                            if (isset($events[$i])) {
                                foreach ($events[$i] as $event) {
                                    if ($currentUser == $event["events_employer"] || $currentRole == 2) {
                                        echo '<a href="javascript: void(0);" class="eventLink" data-id="'
                                            . $event['events_id'] . '" data-type="btnShowDetail" data-d="'
                                            . ((isset($_GET["d"])) ? $_GET["d"] : "") . '" data-go="'
                                            . ((isset($_GET["go"])) ? $_GET["go"] : "") . '">'
                                            . date((($timeFormat == 12) ? 'h:i a' : 'H:i'), strtotime($event["events_start"]))
                                            . ' - ' . date((($timeFormat == 12) ? 'h:i a' : 'H:i'), strtotime($event["events_end"]))
                                            . ' ' . $event["events_description"] . '</a><br>';
                                    } else {
                                        echo '<span>' . date((($timeFormat == 12) ? 'h:i a' : 'H:i'), strtotime($event["events_start"]))
                                            . ' - ' . date((($timeFormat == 12) ? 'h:i a' : 'H:i'), strtotime($event["events_end"]))
                                            . ' ' . $event["events_description"] . '</span><br>';
                                    }
                                }
                            } ?>
                        </td>
                        <?
                        $i++;
                    }
                    $start++;
                    }
                    ?>
                </tr>
            </table>
        </div>
    </div>
    <div id="menuDiv">
        <a href="index.php?c=bookit&a=index&room=<?= $currentRoom ?><?= (isset($_GET["d"])) ? "&d=" . $_GET["d"] : '' ?><?= (isset($_GET["go"])) ? "&go=" . $_GET["go"] : '' ?>"
           class="btn btn-default"
           style="color: #2b669a">Book It</a>&nbsp;&nbsp;
        <? if (App::checkAdmin()) { ?>
            <a href="index.php?c=employeelist&a=index" class="btn btn-default" style="color: #2b669a">Employee
                List</a>
        <? } ?>
    </div>
</div>
<div id="myModal" class="modal fade in" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="false"
     style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">?</button>
                <h4 class="modal-title" id="myModalLabel">B.B DETAILS</h4>
            </div>
            <div class="modal-body">
                <h4>Text in a details boardroom</h4>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th colspan="3" style="text-align: center">Submitted <span id="date_created"></span></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">When:</th>
                            <td id="timeStart"></td>
                            <td id="timeEnd"></td>
                        </tr>
                        <tr>
                            <th scope="row">Notes:</th>
                            <td colspan="2" style="text-align: center" id="description"></td>
                        </tr>
                        <tr>
                            <th scope="row">Who:</th>
                            <td colspan="2" style="text-align: center" id="user"></td>
                        </tr>
                        </tbody>
                    </table
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnUpdate">UPDATE</button>
                <button type="button" class="btn btn-danger" id="btnDelete">DELETE</button>
            </div>
        </div>
    </div>
</div>

<div id="confirmModal" class="modal fade in" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="false"
     style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Confirm</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning" role="alert">
                    Delete only this event or this and all next?
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnYes">Only this</button>
                <button type="button" class="btn btn-danger" id="btnNo">All next</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("input[type=radio]").on("change", function () {
            $.ajax({
                type: "POST",
                url: "index.php?c=index&a=setTimeFormat",
                data: {
                    "timeFormat": $(this).val()
                },
                success: function (response) {
                    $(location).attr('href', 'index.php?room=<?= $currentRoom ?>');
                },
                dataType: "json"
            });
        });
        $('#format').on('click', function () {
            console.log('format = ', $(this).val());
            $.ajax({
                type: "POST",
                url: "index.php?c=index&a=setOptions",
                data: {
                    "options": $(this).val()
                },
                success: function (response) {
                    $(location).attr('href', 'index.php?options=<?= $options ?>');
                },
                dataType: "json"
            });
        });
    });

    $("a[data-type=btnShowDetail]").on("click", function () {
        var eventId = $(this).attr("data-id");

        var d = $(this).attr("data-d");
        var go = $(this).attr("data-go");
        //console.log("open detail", eventId);

        $.ajax({
            type: "POST",
            url: "index.php?c=index&a=detail",
            data: {
                "eventId": eventId
            },
            success: function (response) {
                if (response.status == 'ok') {
                    $("#timeStart").text(response.data.events_start);
                    $("#timeEnd").text(response.data.events_end);
                    $("#user").text(response.data.employerName);
                    $("#description").text(response.data.events_description);
                    $("#btnUpdate").attr("data-id", response.data.events_id);
                    $("#btnDelete").attr("data-id", response.data.events_id);

                    $("#date_created").text(response.data.events_created);
                    $("#myModal").modal("show");
                    if (response.disableAction == 1) {
                        $("#btnUpdate").prop("disabled", true);
                        $("#btnDelete").prop("disabled", true);
                    } else {
                        $("#btnUpdate").prop("disabled", false);
                        $("#btnDelete").prop("disabled", false);
                        $("#btnUpdate").unbind("click").bind("click", function () {
                            var eventId = $(this).attr("data-id");

                            var goToMonth = '';
                            goToMonth += '&d=' + d;
                            goToMonth += '&go=' + go;
                            $(location).attr('href', 'index.php?c=bookit&a=update&id=' + eventId + goToMonth);
                        });
                        $("#btnDelete").unbind("click").bind("click", function () {
                            var eventId = $(this).attr("data-id");

                            $("#confirmModal").modal("show");

                            var goToMonth = '';
                            goToMonth += '&d=' + d;
                            goToMonth += '&go=' + go;

                            $("#btnYes").unbind("click").bind("click", function () {
                                console.log(goToMonth);
                                $(location).attr('href', 'index.php?c=bookit&a=delete&events_id=' + eventId + goToMonth);
                            });
                            $("#btnNo").unbind("click").bind("click", function () {
                                $(location).attr('href', 'index.php?c=bookit&a=delete&events_id=' + eventId + goToMonth + '&all_next');
                            });


                        });
                    }
                } else {
                    alert(response.message);
                }
            },
            dataType: "json"
        });

    });
</script>