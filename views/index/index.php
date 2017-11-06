<style>
    a {
        color: #08088A;
    }

    a:hover {
        color: #0B610B;
    }
</style>
<div id="mainDiv">
    <div class="container-fluid">
        <div id="pageTitleDiv">
            Boardroom Booker
        </div>
    </div>
    <div id="mainFrameDiv" class="container">
        <div>
            <? if ($eventCreateSuccess != "") { ?>
                <div class="alert alert-success" role="alert"><?= $eventCreateSuccess ?></div>
            <? } ?>
            <? if ($eventCreateError != "") { ?>
                <div class="alert alert-danger" role="alert"><?= $eventCreateError ?></div>
            <? } ?>
        </div>
        <div id="contentDiv">
            <div class="btn-group btn-group-justified">
                <? foreach ($rooms as $room) { ?>
                    <a href="index.php?room=<?= $room['rooms_id'] ?>"
                       class="btn btn-primary <?= ($room['rooms_id'] == $currentRoom) ? "active" : "" ?>"
                       style='width: 100%'><?= $room['rooms_name'] ?></a>&nbsp;&nbsp;
                <? } ?>
            </div>
            <div id="timeNavigationMenu">
                <a id="previousMonth" href="?c=index&a=index&d=<?= $d ?>&go=prev" class="btn btn-default"><</a>
                <label><?= $currMonth ?>
                    <?= $currYear ?></label>
                <a id="nextMonth" href="?c=index&a=index&d=<?= $d ?>&go=next" class="btn btn-default">></a>
            </div>
            <div id="calendarDiv">
                <table class="table table-bordered">
                    <tr>
                        <th>Sunday</th>
                        <th>Monday</th>
                        <th>Tuesday</th>
                        <th>Wednesday</th>
                        <th>Thursday</th>
                        <th>Friday</th>
                        <th>Saturday</th>
                    </tr>
                    <tr>
                        <?
                        $start = 0;
                        $i = 1;
                        while ($start < $allDays + $firstDay){
                        if ($start == 7 || $start == 14 || $start == 21 || $start == 28 || $start == 35){
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
                            <td>
                                <?= $i ?><br>
                                <?
                                if (isset($events[$i])) {
                                    foreach ($events[$i] as $event) {
                                        if ($currentUser == $event["events_employer"] || $currentRole == 1) {
                                            echo '<a href="javascript: void(0);" data-id="'.$event['events_id'].'" data-type="btnShowDetail">' . date("H:i", strtotime($event["events_start"])) . ' - ' . date("H:i", strtotime($event["events_end"])) . ' ' . $event["events_description"] . '</a><br>';
                                        } else {
                                            echo '<span>' . date("H:i", strtotime($event["events_start"])) . ' - ' . date("H:i", strtotime($event["events_end"])) . ' ' . $event["events_description"] . '</span><br>';
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
            <a href="index.php?c=bookit&a=index&room=<?= $currentRoom ?>">Book It</a>&nbsp;&nbsp;
            <? if (App::checkAdmin()) { ?>
                <a href="index.php?c=employeelist&a=index">Employee List</a>
            <? } ?>
        </div>
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
                        <th colspan="3" style="text-align: center">Submitted</th>
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
                        <td colspan="2" style="text-align: center" id="description" ></td>
                    </tr>
                    <tr>
                        <th scope="row">Who:</th>
                        <td colspan="2" style="text-align: center" id="user" ></td>
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

<script>
    $("a[data-type=btnShowDetail]").on("click", function(){
        var eventId = $(this).attr("data-id");
        console.log("open detail", eventId);

        $.ajax({
            type: "POST",
            url: "index.php?c=index&a=detail",
            data: {
                "eventId": eventId
            },
            success: function(response){
                if(response.status == 'ok'){
                    $("#timeStart").text(response.data.events_start);
                    $("#timeEnd").text(response.data.events_end);
                    $("#user").text(response.data.employerName);
                    $("#description").text(response.data.events_description);
                    $("#btnUpdate").attr("data-id", response.data.events_id);
                    $("#btnDelete").attr("data-id", response.data.events_id);
                    $("#myModal").modal("show");

                    $("#btnUpdate").unbind("click").bind("click", function(){
                        var eventId = $(this).attr("data-id");
                        $(location).attr('href', 'index.php?c=bookit&a=update&id='+eventId);
                    });
                    $("#btnDelete").unbind("click").bind("click", function(){
                        var eventId = $(this).attr("data-id");
                        $(location).attr('href', 'index.php?c=bookit&a=delete&id='+eventId);

                    });
                }else{
                    alert(response.message);
                }
            },
            dataType: "json"
        });

    });
</script>