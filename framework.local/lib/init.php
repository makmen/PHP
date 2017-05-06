<?php
include('config.php');

function __autoload($class_name) {
    //print_r($class_name."<br />");
    $filename = strtolower($class_name) . '.class.php';
    $file = dirname(__FILE__).'/'.$filename;
    if (file_exists($file) === false) {
        $file = realpath(dirname(__FILE__).'/../'). DIRECTORY_SEPARATOR.'modules\\'.strtolower($class_name).'\\'.$filename;
        if (file_exists($file) === false) {
            return false;
        }
    }
    include_once($file);

    return true;
}

date_default_timezone_set('Africa/Nairobi');

db::init(DB_HOST,DB_PORT,DB_NAME,DB_USER,DB_PASS);

session_start();
