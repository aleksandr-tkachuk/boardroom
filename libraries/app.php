<?php

class  App{

    public static $db;
    public static $config;

    /*
    * application constructor
    */
	public function __construct($config){
        self::$config = $config;
		self::$db = new db_new($config["db"][$config["db"]["type"]]);
	}

    /*
    * return config
    */
    public static function getConfigParams($param){
        return (isset(self::$config[$param])) ? self::$config[$param] : '';
    }

    /*
    * check authorized is admin
    */
    public static function checkAdmin(){
        return (isset($_SESSION["auth"]) && $_SESSION["auth"] == true && $_SESSION["userRole"] == 1) ? true : false;
    }

    /*
    * start application (routing)
    */
	public function start(){
		
        $default = BASE_CONTROLLER;

		if(isset($_GET["c"])){
			$controller = $_GET["c"]."Controller";
		}else{
			$controller = $default;
		}

		if(isset($_GET["a"])){
			$action = $_GET["a"];
		}else{
			$action = "index";
		}

		$c = new $controller;
		if(method_exists($c,$action)){
			$c->$action();
		}else{
			echo "ERROR: $action not found.";
		}
	}

}