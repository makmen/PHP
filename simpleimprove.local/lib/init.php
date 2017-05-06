<?php
    include('config.php');

    function __autoload($className) {
        // print_r($className."<br />");
        $fileName = strtolower($className) . '.class.php';
        $file = dirname(__FILE__).'/'.$fileName;
        if (file_exists($file) === false) {
            $file = realpath(dirname(__FILE__).'/../'). DIRECTORY_SEPARATOR.'modules\\'.strtolower($className).'\\'.$fileName;
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
