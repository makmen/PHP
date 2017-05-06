<?php    
    header("Content-Type: text/html; charset=utf-8");
    define('DOC_ROOT', dirname(realpath(__FILE__)).DIRECTORY_SEPARATOR);
    include('lib/init.php');
    
    $router = router::getInstance(new request());
    $router->show();
    
    echo $router->buffer;