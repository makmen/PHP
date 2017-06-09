<?php

    abstract class ApptEncoder {
        abstract function encode();
    }

    class BloggsApptEncoder extends ApptEncoder {
        function encode() {
            return "Format data BloggsAppt";
        }
    }

    class MegaApptEncoder extends ApptEncoder {
        function encode() {
            return "Format data MegaAppt";
        }
    }

    class RdaApptEncoder extends ApptEncoder {
        function encode() {
            return "Format data RdaAppt";
        }
    }

    class FactoryMethod {
        const BLOGGS = 1;
        const MEGA = 2;
        const RDA = 3;

        private $mode;

        public function __construct($mode) {
            $this->mode = $mode;
        }

        public function getApptEncoder() {
            switch ($this->mode) {
                case (self::MEGA):
                    return new MegaApptEncoder();
                    break;
                case (self::BLOGGS):
                    return new BloggsApptEncoder();
                    break;
                default:
                    return new RdaApptEncoder();
            }
        }
    }

    $obj = new FactoryMethod(FactoryMethod::MEGA);
    $encoder = $obj->getApptEncoder();
    echo $encoder->encode();