<?php
class BookitController extends BaseController{

    public function index(){

        $this->showBackButton = true;

        $currentRoom = (!isset($_GET["room"])) ? 1 : $_GET["room"];

        $user = Employeelist::model()->find($_SESSION['userId']);
        $users = Employeelist::model()->findAll();

        $dateNow = date("Y-m-d", strtotime("now"));
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
            "room" => $currentRoom
        ];

        if(sizeof($_POST) != 0){
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

            $colision = Bookit::checkColision($form);

            if(!$colision) {
                $eventId = $this->createBookit($form);
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

                                $colision = Bookit::checkColision($form);
                                if(!$colision) {
                                    $this->createBookit($form);
                                }else{
                                    $form["errors"][] = "event ".$position." not created, ".$form["startdatetime"]." - ".$form["enddatetime"]." is not empty";
                                    $_SESSION["formErrorMessages"] = "event ".$position." not created, ".$form["startdatetime"]." - ".$form["enddatetime"]." is not empty";
                                }
                                $position++;
                            }
                        }
                    }
                    $_SESSION["formMessages"] = "event ".$form["startdatetime"]." - ".$form["enddatetime"]." has been created";

                    header('Location: index.php?room='.$currentRoom);
                } else {
                    $form["errors"][] = "event not created";
                }
            }else{
                $form["errors"][] = "event not created,".$form["startdatetime"]." - ".$form["enddatetime"]." is not empty";
            }
        }

        $this->render("index", [
            "user"=> $user,
            "users"=>$users,
            "form" => $form

        ]);

    }

    private function createBookit($params){
        $bookit = new Bookit();
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
