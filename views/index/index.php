<div id="roomsDiv">
</div>
<div id="mainDiv">
    <div id="titlesDiv">
        <div id="pageTitleDiv">
            Boardroom Booker
        </div>
    </div>
    <div id="mainFrameDiv">
        <div id="contentDiv">
            <div id="roomNavigationMenu">
                <? foreach ($rooms as $room) { ?>
                    <a href="index.php?room=<?= $room["rooms_id"] ?>"><?= $room["rooms_name"] ?></a>&nbsp;&nbsp;
                <? } ?>
            </div>
            <div id="timeNavigationMenu">
                <a id="previousMonth" href="?c=index&a=index&d=<?= $d ?>&go=prev"><</a>
                <?= $currMonth ?>
                <?= $currYear ?>
                <a id="nextMonth" href="?c=index&a=index&d=<?= $d ?>&go=next">></a>
            </div>
            <div id="calendarDiv">
                <table id="calendarTable">
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
                            <td><?= $i ?></td>
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
            <a href="index.php?c=index&a=bookit">Book It</a>&nbsp;&nbsp;
            <? if (App::checkAdmin()) { ?>
                <a href="index.php?c=index&a=employers">Employee List</a>
            <? } ?>
        </div>
    </div>
</div>