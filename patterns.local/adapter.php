<?php
    header('Content-Type: text/html; charset=UTF-8');

    interface IDuck {

        public function sing();

        public function fly();
    }

    interface ITurkey {

        public function gobble(); // тарахтеть

        public function fly();
    }

    class Duck implements IDuck {
        function sing() {
            echo "Duck Sing<br />";
        }
        function fly() {
            echo "Duck Fly<br />";
        }
    }

    class Turkey implements ITurkey {

        function gobble() {
            echo "Gobble Turkey<br />";
        }

        function fly() {
            echo "Fly Turkey<br />";
        }

    }

    class DuckTurkey implements IDuck {

        private $turkey;

        public function __construct($turkey) {
            $this->turkey = $turkey;
        }

        function sing() {
            $this->turkey->gobble();
        }

        function fly() {
            $this->turkey->fly();
        }
    }

    $duck = new Duck();
    $duck->sing();

    $duck->sing();
    $duck->fly();
    $duck->sing();

    $turkey = new Turkey();
    $turkey->gobble();
    $turkey->fly();
    $turkey->gobble();

    $duckTurkey = new DuckTurkey($turkey);
    $duckTurkey->sing();
    $duckTurkey->fly();
    $duckTurkey->sing();




