<?php
    mb_internal_encoding("UTF-8");
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    set_include_path(get_include_path().PATH_SEPARATOR."core".PATH_SEPARATOR."lib".PATH_SEPARATOR."validators".PATH_SEPARATOR."controllers".PATH_SEPARATOR."models".PATH_SEPARATOR."modules");
    spl_autoload_extensions(".class.php");
    spl_autoload_register();

    define('BASEPATH', dirname(__FILE__));

    AbstractObjectDB::setDB(DataBase::getDBO());

    Route::start();
