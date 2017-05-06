<?php
    header('Content-Type: text/html; charset=UTF-8');
    
    abstract  class Tile {
        abstract function getWealthFactor();
    }
    class Plains extends Tile {
        private $welathFactor = 2;
        
        function getWealthFactor() {
            return $this->welathFactor;
        }
    }

    class DiamodPlains extends Plains {
        function getWealthFactor() {
            return parent::getWealthFactor() + 2;
        }
    }
    class PollutedPlains extends Plains {
        function getWealthFactor() {
            return parent::getWealthFactor() - 4;
        }
    }

    abstract class TileDecarator extends Tile {
        protected $tile;

        function __construct($tile) {
            $this->tile = $tile;
        }
    }
    class DiamodDecarator extends TileDecarator {
        function getWealthFactor() {
            return $this->tile->getWealthFactor() + 2;
        }
    }
    class PollutedDecarator extends TileDecarator {
        function getWealthFactor() {
            return $this->tile->getWealthFactor() - 4;
        }
    }

    $tile = new DiamodDecarator(new Plains());

    //$tile = new PollutedPlains();
    
    echo $tile->getWealthFactor();
