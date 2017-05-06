<?php
	header('Content-Type: text/html; charset=UTF-8');
	
	interface IStrategy {
		public function algorithm();
	}
	
	class ConcreteStrategy1 implements IStrategy {
		public function algorithm() {			echo ("Выполняется алгоритм стратегии 1.");
		}
	}
	
	class ConcreteStrategy2 implements IStrategy {
		public function algorithm() {
			echo ("Выполняется алгоритм стратегии 2.");
		}
	}
	
	class ConcreteStrategy3 implements IStrategy {
		public function algorithm() {
			echo ("Выполняется алгоритм стратегии 3.");
		}
	}
	
	class Context {		private $strategy;
		
		public function __construct() {					}

		public function setStrategy($strategy) {			$this->strategy = $strategy;		}
		
		public function algorithm() {			$this->strategy->algorithm();		}	}

	$obj = new Context();
	$obj->setStrategy(new ConcreteStrategy2());
	$obj->algorithm();
	
