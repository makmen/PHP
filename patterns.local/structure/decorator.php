<?php

    abstract  class Tile {
        abstract function getFactor();
    }
    
    class Plain extends Tile {
        private $factor = 20;
        
        function getFactor() {
            return $this->factor;
        }
    }
        
    class Desert extends Tile {
        private $factor = 12;
        
        function getFactor() {
            return $this->factor;
        }
    }

    abstract class TileDecarator extends Tile {
        protected $tile;

        function __construct($tile) {
            $this->tile = $tile;
        }
        
        function setTile($tile) {
            $this->tile = $tile;
        }
        
        function showFactor() {
            echo get_class($this->tile) . ": " . $this->getFactor() . '<br />';
        }
    }
    
    class DiamondDecarator extends TileDecarator {
        function getFactor() {
            return $this->tile->getFactor() + 2;
        }
    }
    
    class HotDecarator extends TileDecarator {
        function getFactor() {
            return $this->tile->getFactor() - 1;
        }
    }
    
    class WindyDecarator extends TileDecarator {
        function getFactor() {
            return $this->tile->getFactor() - 3;
        }
    }
    
    class PollutedDecarator extends TileDecarator {
        function getFactor() {
            return $this->tile->getFactor() - 5;
        }
    }
    
    $diamondDecarator = new DiamondDecarator( new Plain() );
    $diamondDecarator->showFactor();

    $pollutedDecarator = new PollutedDecarator( new Plain() );
    $pollutedDecarator->showFactor();
    
    $pollutedDecarator->setTile( new Desert() );
    $pollutedDecarator->showFactor();
    
    $windyDecarator = new WindyDecarator( new Plain() );
    $windyDecarator->showFactor();