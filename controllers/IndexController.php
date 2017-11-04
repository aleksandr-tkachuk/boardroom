<?php
class IndexController extends BaseController{

    public function __construct(){
        parent::__construct();
    }

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

        $events = Bookit::model()->findAll(
            [
                "events_room =" => $currentRoom,
                "events_start >=" => date("Y-m-01 00:00:00", $currentTimeStamp),
                "events_end <=" => date("Y-m-".$allDays." 00:00:00", $currentTimeStamp)
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
        //print_r($eventsArray);

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
        );
        $this->render('index', $params);
    }

    /* action logout */
    public function logout(){
        unset($_SESSION["auth"]);
        header("Location: index.php");
    }

    /*/ action auth /*/
    public function auth(){
        //print_r($_POST);
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


