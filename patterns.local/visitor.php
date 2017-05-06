<?php
    header('Content-Type: text/html; charset=UTF-8');
    
    abstract class Unit {
        private $depth;
        function accept( ArmyVisitor $visitor ) {
            $method = "visit" . get_class($this);
            $visitor->$method($this);
        }
        protected function setDepth($depth) {
            $this->depth = $depth;
        }
        function getDepth() {
            return $this->depth;
        }
    }
    
    abstract class ArmyVisitor {
        abstract function visit (Unit $node);
        
        function visitArcher(Archer $node) {
            $this->visit($node);
        }
        function visitLaserUnit(LaserUnit $node) {
            $this->visit($node);
        }
        function visitArmy(Army $node) {
            $this->visit($node);
        }
    }
    
    class TextDumpArmyVisitor extends ArmyVisitor {
        private $text = "";
        
        function visit (Unit $node) {
            $ret = "";
            $ret .= $node->getDepth() . " ";
            $ret .= get_class($node). ": ";
            $ret .= "Огненная мощь: " . $node->bombardStrength() . "<br />";
            $this->text .= $ret;
        }
        
        function getText() {
            return $this->text;
        }
    }
    
    class Army extends Unit {
        private $units = array();
        
        function accept(ArmyVisitor $visitor) {
            $method = "visit" . get_class($this);
            $visitor->$method($this);
            foreach ($this->units as $thisUnit) {
                $thisUnit->accept($visitor);
            }
        }
        function addUnit(Unit $unit) {
            foreach ($this->units as $thisUnit) {
                if ($unit === $thisUnit) {
                    return;
                }
            }
            $unit->setDepth($this->depth+1);
            $this->units[] = $unit;
        }
        function removeUnit(Unit $unit) {
            $units = array();
            foreach ($this->units as $thisUnit) {
                if ($unit !== $thisUnit) {
                    $units[] = $thisUnit;
                }
            }
            $this->units = $units;
        }
        function bombardStrength() {
            $ret = 0;
            foreach ($this->units as $unit) {
                $ret += $unit->bombardStrength();
            }
            
            return $ret;
        }
    }
    
    class Archer extends Unit {
        function bombardStrength() {
            return 4;
        }
    }
    
    class LaserUnit extends Unit {
        function bombardStrength() {
            return 44;
        }
    }
    
    $mainArmy = new Army();
    $mainArmy->addUnit(new Archer());
    $mainArmy->addUnit(new Archer());
    $mainArmy->addUnit(new LaserUnit());
    $subArmy = new Army();
    $subArmy->addUnit(new Archer());
    $subArmy->addUnit(new Archer());
    $mainArmy->addUnit($subArmy);
    
    $textdump = new TextDumpArmyVisitor();
    $mainArmy->accept($textdump);

    print_r( $textdump->getText() );
    
    
    
