<?php
    class Singlton {
        private static $instance;
        private $i = 0;

        private function __construct() {
            echo "Singlton is created";
        }

        public static function getInstance() {
            if (self::$instance === null) {
                self::$instance = new Singlton();
            }

            return self::$instance;
        }
        
        protected function __clone() {
            
        }
        
    }

    $obj = Singlton::getInstance();
    //$obj = clone $obj;
    $obj = Singlton::getInstance();
    $obj = Singlton::getInstance();
    $obj = Singlton::getInstance();
    $obj = Singlton::getInstance();
