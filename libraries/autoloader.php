<?php

if(!function_exists("LibLoader")){
    /*
    * autoloader libraries
    */
    function LibLoader($class){
        $class = strtolower($class);
        $filePath = __DIR__."/".$class.".php";
        if(is_file($filePath) && !class_exists($filePath)){
            include $filePath;
        }
    }
}
if(!function_exists("LibControllers")){
    /*
    * autoloader controllers
    */
    function LibControllers($class){
        $class = ucfirst($class);
        $filePath = __DIR__."/../controllers/".$class.".php";
        if(is_file($filePath) && !class_exists($filePath)){
            include $filePath;
        }
    }
}
if(!function_exists("LibModels")){
    /*
    * autoloader models
    */
    function LibModels($class){
        $class = ucfirst($class);
        $filePath = __DIR__."/../models/".$class.".php";
        if(is_file($filePath) && !class_exists($filePath)){
            include $filePath;
        }
    }
}

/*
 * registration autoloader functions
 */
spl_autoload_register("LibLoader");
spl_autoload_register("LibControllers");
spl_autoload_register("LibModels");