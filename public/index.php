<?php

session_start();

require "../app/core/init.php";
require "../app/core/config.php";

if(DEBUG){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}else{
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
}

$app = new App;
$app->load_controller();