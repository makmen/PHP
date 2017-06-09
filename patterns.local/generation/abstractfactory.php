<?php

    interface ISea {
        public function showSea();
    }
    
    interface IPlain {
        public function showPlain();
    }
    
    interface IForest {
        public function showForest();
    }
    
    class EarthSea implements ISea {
        function __construct() {
            $this->showSea();
        }
        
        function showSea() {
            echo "Earth Sea<br />";
        }
    }
    
    class MarsSea implements ISea {
        function __construct() {
            $this->showSea();
        }
        
        function showSea() {
            echo "Mars Sea<br />";
        }
    }
    
    class EarthPlain implements IPlain {
        function __construct() {
            $this->showPlain();
        }
        
        function showPlain() {
            echo "Earth Plain<br />";
        }
    }
    
    class MarsPlain implements IPlain {
        function __construct() {
            $this->showPlain();
        }
        
        function showPlain() {
            echo "Mars Plain<br />";
        }
    }
    
    class EarthForest implements IForest {
        function __construct() {
            $this->showForest();
        }
        
        function showForest() {
            echo "Earth Forest<br />";
        }
    }
    
    class MarsForest implements IForest {
        function __construct() {
            $this->showForest();
        }
        
        function showForest() {
            echo "Mars Forest<br />";
        }
    }
    
    abstract class TerrainFactory {
        abstract function getSea();
        abstract function getPlain();
        abstract function getForest();
    }
    
    class EarthTerrainFactory extends TerrainFactory {
        function getSea() {
            return new EarthSea();
        }
        
        function getPlain() {
            return new EarthPlain();
        }
        
        function getForest() {
            return new EarthForest();
        }
    }
    
    class MarsTerrainFactory extends TerrainFactory {
        function getSea() {
            return new MarsSea();
        }
        function getPlain() {
            return new MarsPlain();
        }
        function getForest() {
            return new MarsForest();
        }
    }
    
    $factoryEarth = new EarthTerrainFactory();
    $seaEarth = $factoryEarth->getSea();
    $plainEarth = $factoryEarth->getPlain();
    $forestEarth = $factoryEarth->getForest();
    
    $factoryMars = new MarsTerrainFactory();
    $seaMars = $factoryMars->getSea();
    $plainMars = $factoryMars->getPlain();
    $forestMars = $factoryMars->getForest();    