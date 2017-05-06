<?php
    header('Content-Type: text/html; charset=UTF-8');

    class Singlton {
        private static $instance;
        public $i = 0;

        private function __construct() {
            echo "Singlton is created ". ++$i;
        }

        public static function getInstance() {
            if (self::$instance === null) {
                self::$instance = new Singlton();
            }

            return self::$instance;
        }
    }

    $obj = Singlton::getInstance();
    $obj = Singlton::getInstance();
    $obj = Singlton::getInstance();
    $obj = Singlton::getInstance();
    $obj = Singlton::getInstance();
