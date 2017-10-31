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

        $currentTimeStamp = (isset($_GET["d"])) ? strtotime("first day of".$d." month") : strtotime("now");
        $m = date("F", $currentTimeStamp);
        $y = date("Y", $currentTimeStamp);
        $allDays = date("t", $currentTimeStamp);
        //$firstDay = date("w", mktime(0, 0, 0, date("m", $currentTimeStamp), 1, $y));
        $firstDay = date("w", strtotime($y."-".date("m", $currentTimeStamp)."-1"));

        $rooms = Rooms::model()->findAll();

        $params = array(
            "d" => $d,
            "currMonth" => $m,
            "currYear" => $y,
            "allDays" => $allDays,
            "firstDay" => $firstDay,
            "rooms" => $rooms
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
                        $_SESSION["authError"] = "";
                    }
                }else{
                    $_SESSION["authError"] = "user not found";
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

    public function employers(){
        echo 'employers';
    }

    public function bookit(){
        echo 'bookit';    
    }

}


