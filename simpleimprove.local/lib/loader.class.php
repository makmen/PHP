<?php
class loader extends module {
    protected $tplDir;
    
    public function __construct() {
        $this->router = router::getInstance();
    }

    public static function factory($ajax) {
        if (!$ajax) {
            return new loaderindex();
        } else {
            return new loaderajax();
        }
    }
    
    public function takeIndex($index="") {

        return ""; 
    }

}