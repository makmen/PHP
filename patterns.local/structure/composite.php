<?php

    abstract class Component {
        protected $name;

        public function __construct($name) {
            $this->name = $name;
        }

        public abstract function add(Component $c);
        public abstract function remove(Component $c);
        public abstract function display($tab);
    }

    class Composite extends Component {
        private $children = array();

        public function add(Component $component) {
            $this->children[$component->name] = $component;
        }

        public function remove(Component $component) {
            unset($this->children[$component->name]);
        }

        public function display($tab) {
            print_r($tab . $this->name . "<br />");
            foreach ($this->children as $child)
                $child->display($tab . "-");
        }
    }

    class Leaf extends Component {
        public function add(Component $c) {
            print ("Cannot add to a leaf");
        }
        public function remove(Component $c) {
            print("Cannot remove from a leaf");
        }
        public function display($tab) {
            print_r($tab . $this->name);
            echo "<br>";
        }
    }

    $root = new Composite("root");
    $root->add(new Leaf("Leaf A"));
    $root->add(new Leaf("Leaf B"));
    $CC = new Composite("CC");
    $CC->add(new Leaf("Leaf CA"));
    $CC->add(new Leaf("Leaf CB"));
    $CCC = new Composite("Composite CCC");
    $CCC->add(new Leaf("Leaf CCCA"));
    $CC->add($CCC);
    
    $root->add($CC);
    $root->add(new Leaf("Leaf D"));
    
    $root->display("");