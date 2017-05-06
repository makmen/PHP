<?php

class module {
    protected $out = array();
    protected $compiler;
    
    protected $module;
    protected $template;
    protected $id;

    protected $options;
    
    protected $titleHtml;

    public function __construct() {
        $this->compiler = compiler::getInstance();
        $this->out = $this->compiler->vars;
        $this->module = $this->compiler->vars['parentmodule'];
        $this->template = $this->compiler->vars['parenttemplate'];
        $this->id = $this->compiler->vars['parentid'];
        if (file_exists(DOC_ROOT. $this->compiler->mdDir . $this->module . '/mdOpts.php')){
            $this->options = include($this->compiler->mdDir . $this->module . '/mdOpts.php');
    	}
    }
    
    public function getOut() {
        return $this->out;
    }
    
    public function defaultTemplate($template) {
        $this->template = $this->out['parenttemplate'] = $template;
    }
    
    public function createFromTemplate($template) {
        return compiler::createFromTemplate($template, $this->out);
    }

    
}

