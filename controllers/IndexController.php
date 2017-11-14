<?php
class IndexController extends BaseController{

    public function __construct(){
        parent::__construct();
    }

    /*
    * calendar page
    */
    public function index(){
        $d = (isset($_GET["d"])) ? $_GET["d"] : 0;
        if(isset($_GET["go"])){
            if($_GET["go"] == "prev"){
                $d--;
            }elseif($_GET["go"] == "next"){
                $d++;
            }
        }

        $currentRoom = (!isset($_GET["room"])) ? 1 : $_GET["room"];

        $currentTimeStamp = (isset($_GET["d"])) ? strtotime("first day of".$d." month") : strtotime("now");
        $m = date("F", $currentTimeStamp);
        $y = date("Y", $currentTimeStamp);
        $allDays = date("t", $currentTimeStamp);
        //$firstDay = date("w", mktime(0, 0, 0, date("m", $currentTimeStamp), 1, $y));
        $firstDay = date("w", strtotime($y."-".date("m", $currentTimeStamp)."-1"));

        $rooms = Rooms::model()->findAll();

        /*
        * get events for current month
        */
        $events = Bookit::model()->findAll(
            [
                "events_room =" => $currentRoom,
                "events_start >=" => date("Y-m-01 00:00:00", $currentTimeStamp),
                "events_end <=" => date("Y-m-".$allDays." 23:59:59", $currentTimeStamp)
            ],
            [
                "events_start" => "asc"
            ]
        );

        $eventsArray = [];
        foreach($events as $event){
            $day = date("j", strtotime($event["events_start"]));
            $eventsArray[$day][] = $event;
        }

        $eventCreateSuccess = (isset($_SESSION["formMessages"])) ? $_SESSION["formMessages"] : "";
        $eventCreateError = (isset($_SESSION["formErrorMessages"])) ? $_SESSION["formErrorMessages"] : "";
        unset($_SESSION["formMessages"]);
        unset($_SESSION["formErrorMessages"]);

        $params = array(
            "currentRoom" => $currentRoom,
            "currentUser" => $_SESSION['userId'],
            "currentRole" => $_SESSION["userRole"],
            "d" => $d,
            "currMonth" => $m,
            "currYear" => $y,
            "allDays" => $allDays,
            "firstDay" => $firstDay,
            "rooms" => $rooms,
            "events" => $eventsArray,
            "eventCreateSuccess" => $eventCreateSuccess,
            "eventCreateError" => $eventCreateError,
            "timeFormat" => (isset($_SESSION["timeFormat"])) ? $_SESSION["timeFormat"] : 12
        );
        $this->render('index', $params);
    }

    /*
    * return event detail in json format
    */
    public function detail(){
        if(isset($_POST["eventId"]) && $_POST["eventId"] != ""){
            $event = Bookit::model()->find($_POST["eventId"]);
            $event->employerName = Employeelist::model()->find($event->events_employer)->users_name;

            echo json_encode([
                "status" => "ok",
                "data" => $event,
                "disableAction" => ($event->events_end < date("Y-m-d H:i:s", strtotime("now"))) ? 1 : 0,
            ]);
        }else{
            echo json_encode([
                "status" => "error",
                "message" => "Bad Request: event id is empty"
            ]);
        }
    }

    /*
    * set time format (12/24)
    */
    public function setTimeFormat(){
        if(isset($_POST["timeFormat"]) && $_POST["timeFormat"] != ""){
            $_SESSION["timeFormat"] = $_POST["timeFormat"];
        }else{
            $_SESSION["timeFormat"] = 12;
        }
        echo json_encode([ "status" => "ok"]);
    }

    /* action logout */
    public function logout(){
        unset($_SESSION["auth"]);
        header("Location: index.php");
    }

    /*/ action auth /*/
    public function auth(){

        if(sizeof($_POST) != 0){
            if($_POST["login"] != "" && $_POST["password"] != ""){
                $user = User::model()->findByLogin($_POST["login"]);

                if($user != null){
                    if(md5($_POST["password"]) !== $user->users_password){
                        $_SESSION["authError"] = "password is incorrect";
                    }else{
                        $_SESSION["auth"] = true;
                        $_SESSION["authName"] = $user->users_name;
                        $_SESSION["userRole"] = $user->users_role;
                        $_SESSION["userId"] = $user->users_id;

                        $_SESSION["authError"] = "";
                    }
                }else{
                    $_SESSION["authError"] = "employeelist not found";
                }
            }else{
                $_SESSION["authError"] = "login or password is empty";
            }
        }
        if(isset($_SESSION["auth"]) && $_SESSION["auth"]){
            header("Location: index.php");
        }else{
            $this->render('login');
            exit();
        }
    }


}


