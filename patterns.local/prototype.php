<?php
    header('Content-Type: text/html; charset=UTF-8');

    class Sea {  }
    class EarthSea extends Sea {
        function showSea() {
            echo "Earth Sea<br />";
        }
    }
    class MarshSea extends Sea {
        function showSea() {
            echo "Marsh Sea<br />";
        }
    }
    class Plain { }
    class EarthPlain extends Plain {
        function showPlain() {
            echo "Earth Plain<br />";
        }
    }
    class MarsPlain extends Plain {
        function showPlain() {
            echo "Mars Plain<br />";
        }
    }
    class Forest { 
        
    }    
    class EarthForest extends Forest {
        function showForest() {
            echo "Earth Forest<br />";
        }
    }
    class MarsForest extends Forest {
        function showForest() {
            echo "Mars Forest<br />";
        }
    }
    
    class TerrainFactory {
        private $sea;
        private $plain;
        private $forest;
        
        public function __construct($sea, $plain, $forest) {
            $this->sea = $sea;
            $this->plain = $plain;
            $this->forest = $forest;
        }
        
        public function getSea() {
            return clone $this->sea;
        }
        public function getPlain() {
            return clone $this->plain;
        }
        public function getForest() {
            return clone $this->forest;
        }
    }
    
    $factory = new TerrainFactory( new EarthSea(), new EarthPlain(), new EarthForest() );
    $obj = $factory->getSea();
    $obj->showSea();
    $obj = $factory->getPlain();
    $obj->showPlain();
    $obj = $factory->getForest();
    $obj->showForest();
    
    
    
    
    
    
    
    
    
    
    /*class Person {
        private $name; 
        private $age;
        private $id;
        public function __construct($name, $age) {
            $this->name = $name;
            $this->age = $age;
        }
        public function setId($id) {
            $this->id = $id;
        }
        public function show() {
            echo $this->name . " " . $this->age . " " . $this->id;
            echo "<br>";
        }
        
        public function __clone() {
            $this->id = 0;
        }
    }
    $obj1 = new Person("kron", 25);
    $obj1->setId(11);
    $obj2 = clone $obj1;
    $obj1->show();
    $obj2->show();

     */
