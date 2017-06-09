<?php

    interface IStrategy {
        public function algorithm();
    }

    class XSMLStrategy implements IStrategy {
        public function algorithm() {
            echo ('XSML Strategy<br />');
        }
    }

    class HTMLStrategy implements IStrategy {
        public function algorithm() {
            echo ('HTML Strategy<br />');
        }
    }

    class JSONStrategy implements IStrategy {
        public function algorithm() {
            echo ('JSON Strategy<br />');
        }
    }

    class Strategy {
        private $strategy;

        public function setStrategy(IStrategy $strategy) {
            $this->strategy = $strategy;
        }

        public function algorithm() {
            $this->strategy->algorithm();
        }
    }

    $strategy = new Strategy();
    $strategy->setStrategy(new XSMLStrategy());
    $strategy->algorithm();
    $strategy->setStrategy(new HTMLStrategy());
    $strategy->algorithm();
    $strategy->setStrategy(new JSONStrategy());
    $strategy->algorithm();