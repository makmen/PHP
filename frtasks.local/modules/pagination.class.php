<?php

class Pagination extends Module {

    private $render = "";
    function setRender($render) {
        $this->render = $render;
    }
    
    function showRender() {
        echo $this->render;
    }
        
    public $patern = 'page';
   

    public function __construct() {
        parent::__construct();
        $this->add("total");
        $this->add("on_page");
        $this->add("active");
        $this->add("offset");
        $this->add("firstPage", 1);
        $this->add("lastPage");
        $this->add("url", array(), true);
    }

    public function getTmplFile() {
        return "pagination";
    }
    


}
