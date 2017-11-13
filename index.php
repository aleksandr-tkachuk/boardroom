<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('Europe/Kiev');

define("BASE_CONTROLLER", "IndexController");

include("config/config.php");
include("libraries/autoloader.php");


/*
* create App object and run start(routing)
*/
$app = new App($config);
$app->start();
