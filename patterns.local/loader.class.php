<?php
class loader {
    private static $instance;
    protected $tplDir;
    
    protected function __construct() {

    }
    
    public static function getInstance($ajax=false) {
        if (self::$instance === null) {
            self::$instance = loader::factory($ajax);
        }

        return self::$instance;
    }

    public static function factory($ajax) {
        if (!$ajax) {
            return new loaderindex();
        } else {
            return null;
        }
    }
    
    public function takeIndex($index="") {

        return ""; 
    }

}

class loaderindex extends loader {
    
    protected function __construct() {
        parent::__construct();
        $this->tplDir = 'templates/front/';
    }
    
    public function getTemplate($params) {
        $content = "222";

        return $content;
    }


}

$loader = loader::getInstance(false);

    $loader = loader::getInstance(false);
    $loader = loader::getInstance(false);
    $loader = loader::getInstance(false);


echo "<pre>";
print_r(111);
exit;

