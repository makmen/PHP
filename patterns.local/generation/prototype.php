<?php

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
    
    class Forest { }   
    
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
    
    $factory = new TerrainFactory(
        new EarthSea(), new EarthPlain(), new EarthForest()
    );
    $factory->getSea()->showSea();
    $factory->getPlain()->showPlain();
    $factory->getForest()->showForest();
    
    $factory = new TerrainFactory(
        new MarshSea(), new MarsPlain(), new EarthForest()
    );
    $factory->getSea()->showSea();
    $factory->getPlain()->showPlain();
    $factory->getForest()->showForest();