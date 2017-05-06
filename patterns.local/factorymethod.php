<?php
	header('Content-Type: text/html; charset=UTF-8');
	
	abstract class ApptEncoder {		abstract function encode();	}
	
	class BloggsApptEncoder extends ApptEncoder {		function encode() {			return "Данные в формате BloggsAppt";		}	}
	
	class MegaApptEncoder extends ApptEncoder {
		function encode() {
			return "Данные в формате MegaAppt";
		}
	}
	
	class RdaApptEncoder extends ApptEncoder {
		function encode() {
			return "Данные в формате RdaAppt";
		}
	}
	
	class FactoryMethod {		const BLOGGS = 1;
		const MEGA = 2;
		const RDA = 3;
		private $mode;
		public function __construct( $mode ) {			$this->mode = $mode;		}
		
		public function getApptEncoder() {			
			switch ($this->mode) {				case (self::MEGA):
					return new MegaApptEncoder();
					break;
				case (self::BLOGGS):
					return new BloggsApptEncoder();
					break;
				default:
					return new RdaApptEncoder();			}		}
	}

	$obj = new FactoryMethod( FactoryMethod::RDA );
	$encoder = $obj->getApptEncoder();
	echo $encoder->encode();
	
