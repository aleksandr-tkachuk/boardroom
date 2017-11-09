<?php
class BookitController extends BaseController{

    public function index(){

       //$this->showBackButton = true;

        $currentRoom = (!isset($_GET["room"])) ? 1 : $_GET["room"];

        $user = Employeelist::model()->find($_SESSION['userId']);
        $users = Employeelist::model()->findAll();

        $dateNow = date("Y-m-d", strtotime("now"));
        $dateTimeStart = date("Y-m-d H:i:s", strtotime("now"));
        $dateTimeEnd = date("Y-m-d H:i:s", strtotime("+30 minutes"));
        $timeStart = date("H:00", strtotime("+1 hour"));
        $timeEnd = date("H:30", strtotime("+1 hour"));

        $form = [
            "user" => 0,
            "date" => $dateNow,
            "start" => $timeStart,
            "end" => $timeEnd,
            "description" => "",
            "recurring" => 0,
            "specify" => 1,
            "duration" => 0,
            "errors" => [],
            "room" => $currentRoom,
        ];

        if(sizeof($_POST) != 0){
            //print_r($_POST);exit();
            $form = $_POST;
            $form["room"] = $currentRoom;
            $form["errors"] = [];

            if($form["start"] >= $form["end"]){
                $form["errors"][] = "need start < end";
            }

            $form["startdatetime"] = $form["date"]." ".$form["start"];
            $form["enddatetime"] = $form["date"]." ".$form["end"];
            $form["parent"] = 0;
            $form["position"] = 0;

            $this->checkBookit($form, $currentRoom);
        }

        $this->render("index", [
            "user"=> $user,
            "users"=>$users,
            "form" => $form,
            "dateStartNow" => $dateTimeStart,
            "dateEndNow" => $dateTimeEnd,
            "timeFormat" => (isset($_SESSION["timeFormat"])) ? $_SESSION["timeFormat"] : 12
        ]);

    }

    private function checkBookit($form, $currentRoom, $action = 'add'){
        //print_r($form);exit();
        $colision = Bookit::checkColision($form, $action);

        if(!$colision) {
            $eventId = $this->createBookit($form, $action);

            $eventsRecurring = Bookit::model()->findAll(["events_parent =" => $eventId]);
//            echo $eventId;
//            print_r($eventsRecurring);
            if($action == 'update' && sizeof($eventsRecurring) != 0){

                $applyAll = (isset($form["btnApplyAll"])) ? $form["btnApplyAll"] : "off";
                if($applyAll == 'on'){
                    foreach ($eventsRecurring as $event){
                        $form["id"] = $event["events_id"];
                        $form["position"] = $event["events_position"];
                       // var_dump($form["id"]);
                        if ($form["duration"] != 0) {
                            $position = 1;
                            for ($i = 1; $i < $form["duration"]; $i++) {
                                if ($form["specify"] == 1) {
                                    $form["startdatetime"] = date(
                                        "Y-m-d H:i",
                                        strtotime("+" . $i . " week " . $form["date"] . " " . $form["start"])
                                    );
                                    $form["enddatetime"] = date(
                                        "Y-m-d H:i",
                                        strtotime("+" . $i . " week " . $form["date"] . " " . $form["end"])
                                    );
                                }
                                if ($form["specify"] == 2) {
                                    $i++;
                                    $form["startdatetime"] = date(
                                        "Y-m-d H:i",
                                        strtotime("+" . $i . " week " . $form["date"] . " " . $form["start"])
                                    );
                                    $form["enddatetime"] = date(
                                        "Y-m-d H:i",
                                        strtotime("+" . $i . " week " . $form["date"] . " " . $form["end"])
                                    );
                                }
                                if ($form["specify"] == 3) {
                                    $form["startdatetime"] = date(
                                        "Y-m-d H:i",
                                        strtotime("+" . $i . " month " . $form["date"] . " " . $form["start"])
                                    );
                                    $form["enddatetime"] = date(
                                        "Y-m-d H:i",
                                        strtotime("+" . $i . " month " . $form["date"] . " " . $form["end"])
                                    );
                                }

                                $form["parent"] = $eventId;
                                $form["position"] = $position;

                                $colision = Bookit::checkColision($form, "update");
                                if (!$colision) {
                                    $this->createBookit($form, "update");
                                } else {
                                    $form["errors"][] = "event " . $position . " not updated, " . $form["startdatetime"] . " - " . $form["enddatetime"] . " is not empty";
                                    $_SESSION["formErrorMessages"] = "event " . $position . " not updated, " . $form["startdatetime"] . " - " . $form["enddatetime"] . " is not empty";
                                }
                                $position++;
                            }
                        }
                    }
                }
                header('Location: index.php?room=' . $currentRoom);
            }else {
                if ($eventId != 0) {
                    if ($form["recurring"] == 1) {
                        if ($form["duration"] != 0) {
                            $position = 1;
                            for ($i = 1; $i < $form["duration"]; $i++) {
                                if ($form["specify"] == 1) {
                                    $form["startdatetime"] = date(
                                        "Y-m-d H:i",
                                        strtotime("+" . $i . " week " . $form["date"] . " " . $form["start"])
                                    );
                                    $form["enddatetime"] = date(
                                        "Y-m-d H:i",
                                        strtotime("+" . $i . " week " . $form["date"] . " " . $form["end"])
                                    );
                                }
                                if ($form["specify"] == 2) {
                                    $i++;
                                    $form["startdatetime"] = date(
                                        "Y-m-d H:i",
                                        strtotime("+" . $i . " week " . $form["date"] . " " . $form["start"])
                                    );
                                    $form["enddatetime"] = date(
                                        "Y-m-d H:i",
                                        strtotime("+" . $i . " week " . $form["date"] . " " . $form["end"])
                                    );
                                }
                                if ($form["specify"] == 3) {
                                    $form["startdatetime"] = date(
                                        "Y-m-d H:i",
                                        strtotime("+" . $i . " month " . $form["date"] . " " . $form["start"])
                                    );
                                    $form["enddatetime"] = date(
                                        "Y-m-d H:i",
                                        strtotime("+" . $i . " month " . $form["date"] . " " . $form["end"])
                                    );
                                }

                                $form["parent"] = $eventId;
                                $form["position"] = $position;

                                $colision = Bookit::checkColision($form, "add");
                                if (!$colision) {
                                    $this->createBookit($form, "add");
                                } else {
                                    $form["errors"][] = "event " . $position . " not created, " . $form["startdatetime"] . " - " . $form["enddatetime"] . " is not empty";
                                    $_SESSION["formErrorMessages"] = "event " . $position . " not created, " . $form["startdatetime"] . " - " . $form["enddatetime"] . " is not empty";
                                }
                                $position++;
                            }
                        }
                    }
                    $_SESSION["formMessages"] = "event " . $form["startdatetime"] . " - " . $form["enddatetime"] . " has been ".($action == 'add') ? 'create' : 'updated';

                    header('Location: index.php?room=' . $currentRoom);
                } else {
                    $form["errors"][] = "event not ".($action == 'add') ? 'create' : 'updated';
                }
            }
        }else{
            $form["errors"][] = "event not created,".$form["startdatetime"]." - ".$form["enddatetime"]." is not empty";
        }
    }

    public function update(){
        $eventId = (isset($_GET["id"])) ? $_GET["id"] : '';
        if($eventId){
            $event = Bookit::model()->find($eventId);
            $form = [
                "id" => $event->events_id,
                "user" => $event->events_employer,
                "date" =>  date("Y-m-d", strtotime($event->events_start)),
                "start" =>  date("H:i", strtotime($event->events_start)),
                "end" => date("H:i", strtotime($event->events_end)),
                "description" => $event->events_description,
                "recurring" => $event->events_recurring,
                "specify" => $event->events_specify,
                "duration" => $event->events_duration,
                "errors" => [],
                "room" => $event->events_room
            ];

            if(sizeof($_POST) != 0){
                $form = $_POST;

                $event = Bookit::model()->find($form["id"]);
                $dDays = 0;
                if($form["date"] != date("Y-m-d", strtotime($event->events_start))){
//                    echo "!!!";
                    list($date, $time) = explode(" ", $event->events_start);

                    $dDays = (strtotime($form["date"]." 00:00:00") - strtotime($date." 00:00:00"))/60/60/24;
//                    echo $dDays;

                }

                $applyAll = (isset($form["btnApplyAll"])) ? $form["btnApplyAll"] : "off";
                //print_r($event);exit();
                //echo $event->events_parent ," -- ", $applyAll;
                if($applyAll == 'on'){
                    if($event->events_parent != 0) {
                        $event = Bookit::model()->find($event->events_parent);
                        $form["date"] = date("Y-m-d", strtotime($dDays." days ".$event->events_start));
                    }

                    $form["position"] = 0;
                }else{
                    $form["position"] = $event->events_position;
                }
                //print_r($event);exit();
                $form["room"] = $event->events_room;
                $form["id"] = $event->events_id;
                $form["parent"] = $event->events_parent;
                $form["errors"] = [];

                if($form["start"] >= $form["end"]){
                    $form["errors"][] = "need start < end";
                }

                $form["startdatetime"] = $form["date"]." ".$form["start"];
                $form["enddatetime"] = $form["date"]." ".$form["end"];

//                print_r($form);
//                print_r($event);
//                exit();
                $this->checkBookit($form, $event->events_room, "update");
            }
            $user = Employeelist::model()->find($_SESSION['userId']);
            $users = Employeelist::model()->findAll();

            $this->render("update", [
                "user"=> $user,
                "users"=>$users,
                "form" => $form

            ]);
        }else{
            echo "event not found";
        }
    }

    public function delete() {
        //print_r($_GET);
        $deleteAllNext = (isset($_GET["all_next"])) ? true : false;

        if($deleteAllNext){
//            echo "all";
            if (isset($_GET['events_id'])) {
                $room = Bookit::deleteAllNext($_GET['events_id']);
            }
        }else {
//            echo "one";
            if (isset($_GET['events_id'])) {
                $event = Bookit::model()->find($_GET['events_id']);
                $room = $event->events_room;
                $event->delete();
            }
        }
        header('Location: index.php?c=index&room='.$room);

    }

    private function createBookit($params, $action){
        if($action == 'add') {
            $bookit = new Bookit();
            $bookit->events_created = date("Y-m-d H:i:s", strtotime("now"));
        }else{
            $bookit = Bookit::model()->find($params["id"]);
        }
        $bookit->events_employer = $params["user"];
        $bookit->events_start = $params["startdatetime"];
        $bookit->events_end =  $params["enddatetime"];
        $bookit->events_description = $params["description"];
        $bookit->events_recurring = $params["recurring"];
        $bookit->events_specify = $params["specify"];
        $bookit->events_duration = $params["duration"];
        $bookit->events_parent = $params["parent"];
        $bookit->events_position = $params["position"];
        $bookit->events_room = $params["room"];

        if($bookit->save()){
            return $bookit->events_id;
        }else{
            return 0;
        }
    }
}
