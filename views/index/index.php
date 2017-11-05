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
                                            echo '<a href="#myModal" data-toggle="modal">' . date("H:i", strtotime($event["events_start"])) . ' - ' . date("H:i", strtotime($event["events_end"])) . ' ' . $event["events_description"] . '</a><br>';
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
     style="display: hide;">
    <?php var_dump($_SESSION)?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">?</button>
                <h4 class="modal-title" id="myModalLabel">B.B DETAILS</h4>
            </div>
            <div class="modal-body">
                <h4>Text in a details boardroom</h4>
                <div class="table-responsive">
                <table  class="table table-bordered table-striped"
                        data-toggle="table"
                        data-url="index.php"
                        data-cache="false"
                        data-height="299">
                    <thead>
                    <tr>
                        <th colspan="3" style="text-align: center">Submitted</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">When:</th>
                        <td data-field="time">time start</td>
                        <td data-field="time">time end</td>
                    </tr>
                    <tr>
                        <th scope="row">Notes:</th>
                        <td colspan="2" style="text-align: center" data-field="description" >Meeting</td>
                    </tr>
                    <tr>
                        <th scope="row">Who:</th>
                        <td colspan="2" style="text-align: center" data-field="name" >User</td>
                    </tr>
                    </tbody>
                </table
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">UPDATE</button>
                <button type="button" class="btn btn-danger">DELETE</button>
            </div>
        </div>
    </div>
</div>
<style>
    a {
        color: #08088A;
    }

    a:hover {
        color: #0B610B;
    }
</style>
