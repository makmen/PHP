<?php
	header('Content-Type: text/html; charset=UTF-8');
/*
	interface IApptEncoder {
		public function encode();
	}
	interface ITtdEncoder {
		public function encode();
	}
	interface IContactEncoder {
		public function encode();
	}
	class BloggsApptEncoder implements IApptEncoder {
		function encode() {
			return "Данные Appt в формате Bloggs";
		}
	}
	class BloggsTtdEncoder implements ITtdEncoder {
		function encode() {
			return "Данные Ttd в формате Bloggs";
		}
	}
	class BloggsContactEncoder implements IContactEncoder {
		function encode() {
			return "Данные Contact в формате Bloggs";
		}
	}
	
	class MegaApptEncoder implements IApptEncoder {
		function encode() {
			return "Данные Appt в формате Mega";
		}
	}
	class MegaTtdEncoder implements ITtdEncoder {
		function encode() {
			return "Данные Ttd в формате Mega";
		}
	}
	class MegaContactEncoder implements IContactEncoder {
		function encode() {
			return "Данные Contact в формате Mega";
		}
	}
	
	abstract class AbstractFactory {
		abstract function getHeaderText();
		abstract function getApptEncoder();
		abstract function getTtdEncoder();
		abstract function getContactEncoder();
		abstract function getFooterText();
	}
	
	class BloggsFactory extends AbstractFactory {
		function getHeaderText() {
			return "Bloggs Header";
		}
		function getApptEncoder() {
			return new BloggsApptEncoder();
		}
		function getTtdEncoder() {
			return new BloggsTtdEncoder();
		}
		function getContactEncoder() {
			return new BloggsContactEncoder();
		}
		function getFooterText() {
			return "Bloggs Footer";
		}
	}
	
	class MegaFactory extends AbstractFactory {
		function getHeaderText() {
			return "Mega Header";
		}
		function getApptEncoder() {
			return new MegaApptEncoder();
		}
		function getTtdEncoder() {
			return new MegaTtdEncoder();
		}
		function getContactEncoder() {
			return new MegaContactEncoder();
		}
		function getFooterText() {
			return "Mega Footer";
		}
	}

	$factory = new BloggsFactory();
	$encoder = $factory->getApptEncoder();
	echo $encoder->encode();
 * 
 */

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
    
    $factory = new MarsTerrainFactory();
    $obj = $factory->getSea();
 

