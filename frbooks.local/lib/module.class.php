<?php

class module {
    protected $router;
    protected $out = array();

    protected $module;
    protected $template;
    protected $id;
    
    protected $options;

    public function __construct($md, $template, $id) {
        $this->router = router::getInstance();
        $this->module = $md;
        $this->template = $template;
        $this->id = $id;
        $this->out = $this->router->out;

        if (file_exists(DOC_ROOT. $this->router->mdDir . $this->module . '/mdOpts.php')){
            $this->options = include($this->router->mdDir . $this->module . '/mdOpts.php');
    	}
    }
    
    public function getParamsModule() {
        $ret['module'] = $this->module;
        $ret['template'] = $this->template;
        
        return $ret;
    }
    
    public function getOut() {
        return $this->out;
    }
    
    public function display($template) {
        $this->router->out = $this->getOut();
        $content = "";
        if (is_file(DOC_ROOT . $this->router->tplDir .  $template)) {
            $content = $this->router->display(DOC_ROOT . $this->router->tplDir .  $template);
        }
        
        return $content;
    }
  


}

