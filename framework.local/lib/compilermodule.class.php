<?php
/* при создании объекта compilermodule он должен иметь шаблон  */ 
class compilermodule {
    private $pathToCompiled;
    private $compiler;

    public function __construct() {
        $this->compiler = compiler::getInstance();
        $this->pathToCompiled = ($this->compiler->vars['module'] != '' && !isset($this->compiler->vars['modulenotfound'])) ?
            ((!isset($this->compiler->vars['noAccess'])) ? 
                ($this->compiler->cmpDir . $this->compiler->vars['module'] . '/_' . $this->compiler->vars['template']. '.tpl') :
                ($this->compiler->cmpDir . $this->compiler->vars['module'] . '/_noAccess_' . $this->compiler->vars['template']. '.tpl')) :
            $this->compiler->cmpDir . $this->compiler->index;
    }
    
    public function startCompiling() {
        if (!$this->compiler->recompile && is_file($this->pathToCompiled)) {
            $content = file_get_contents($this->pathToCompiled);
        } else {
            $content = $this->compiler->compile($this->compiler->index);
            $this->compiler->compilingSave($content, $this->pathToCompiled);
        }
        $content = $this->compiler->getContents($this->compiler, $content, $this->pathToCompiled);
        
        return $content;
    }


    
}

