<?php
    header("Content-Type: text/html; charset=utf-8");
    define('DOC_ROOT', dirname(realpath(__FILE__)).DIRECTORY_SEPARATOR);
    include(DOC_ROOT.'lib/init.php');

    $compiler = compiler::getInstance(new request());
    $compiler->loadModule(true);

    $compiler->recompile = false; // true - будет рекомпилить каждый раз новый    
    
    $compiler->build();

    





    
 