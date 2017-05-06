<?php
    include('config.php');

    function __autoload($className) {
        //print_r($class_name."<br />");
        $fileName = strtolower($className) . '.class.php';
        $file = dirname(__FILE__).'/'.$fileName;
        if (file_exists($file) === false) {
            return false;
        }
        include_once($file);

        return true;
    }

    date_default_timezone_set('Africa/Nairobi');
