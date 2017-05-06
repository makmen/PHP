<?php
    header('Content-Type: text/html; charset=UTF-8');

    class Registry {
        private static $instance;
        private $request;
        private function __construct() { }
        static function getInstance() {
            if (isset (self::$instance)) {
                return self::$instance;
            } else {
                self::$instance = new self();
            }
        }
        function getRequest() {
            return $request;
        }
        function setRequest($request) {
            $this->request = $request;
        }
    }
    
    class Request { } // пустой для тестирования

    $request = new Request();
    $obj = Registry::getInstance();
    $obj->setRequest($request);
    
    $reg = Registry::getInstance();
    //$reg->getRequest()// получаем доступ из другой системы
