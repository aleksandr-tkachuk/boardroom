<?php

/* базовый контролеер */
abstract class BaseController{

    protected $showBackButton = false;

    /*
    * controller constroctor
    */
    public function __construct(){
        $c = (isset($_GET["c"])) ? $_GET["c"] : "index";
        $a = (isset($_GET["a"])) ? $_GET["a"] : "index";

        if(
            (!isset($_SESSION["auth"]) || $_SESSION["auth"] == false) &&
            $c === "index" &&
            $a !== "auth"
        ){
            $_SESSION["authError"] = "";
            $this->render('login');
            exit();
        }
    }


    /* function render
    * отрисовка шаблона
    */
    protected  function render($view, $params = array()){
        $keys = array_keys($params);
        foreach($keys as $name){
            $$name = $params[$name];
        }

        $controller = strtolower(str_replace("Controller", "", get_class($this)));
        if(file_exists(BASE_PASS."/views/$controller/".$view.".php")){
            include(BASE_PASS."/views/includes/headers.php");
            include(BASE_PASS."/views/$controller/".$view.".php");
            include(BASE_PASS."/views/includes/footer.php");
        }else{
            echo "view ". $view.".php not found";
            exit();
        }
    }
}