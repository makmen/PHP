<?php
    header('Content-Type: text/html; charset=UTF-8');

abstract class Component
{
    protected $name;

    // Constructor
    public function __construct($name) {
        $this->name = $name;
    }

    public abstract function add(Component $c);
    public abstract function remove(Component $c);
    public abstract function display();
}
class Composite extends Component
{
    private $children = array();

    public function add(Component $component) {
        $this->children[$component->name] = $component;
    }

    public function remove(Component $component) {
        unset($this->children[$component->name]);
    }

    public function display() {
        foreach($this->children as $child)
            $child->display();
    }
}
class Leaf extends Component
{
    public function add(Component $c) {
        print ("Cannot add to a leaf");
    }

    public function remove(Component $c) {
        print("Cannot remove from a leaf");
    }

    public function display() {
        print_r($this->name);
        echo "<br>";
    }
}

// Create a tree structure
$root = new Composite("root");

$root->add(new Leaf("Leaf A"));
$root->add(new Leaf("Leaf B"));

$comp = new Composite("Composite X");

$comp->add(new Leaf("Leaf XA"));
$comp->add(new Leaf("Leaf XB"));
$root->add($comp);
$root->add(new Leaf("Leaf C"));

// Add and remove a leaf
$leaf = new Leaf("Leaf D");
$root->add($leaf);
$root->remove($leaf);

// Recursively display tree
$root->display();
    
    /*
    abstract  class Unit {
        function getComposite() {
            return null; 
        }
        abstract  function bombardStrength();
    }
    
    abstract class CompositeUnit extends Unit {
        private $units = array();
        
        function getComposite() {
            return $this;
        }

        protected function getUnits() {
            return $this->units;
        }
    
        function addUnit(Unit $unit) {
            if (in_array($unit, $this->units, true)) {
                return;
            }
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
    }

    class Army extends Unit {
        private $units = array();
        
        function addUnit(Unit $unit) {
            if (in_array($unit, $this->units, true)) {
                return;
            }
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
    $mainArmy->addUnit(new Archer());
    $mainArmy->addUnit(new LaserUnit());
    
    $subArmy = new Army();
    $subArmy->addUnit(new Archer());
    $subArmy->addUnit(new LaserUnit());
    
    $mainArmy->addUnit($subArmy);

    print_r($mainArmy->bombardStrength());

    
    
    */