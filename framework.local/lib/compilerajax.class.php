<?php
/* ajax может не иметь шаблона */
class compilerajax {
    private $pathToCompiled;
    private $compiler;
    private $tplDirAjax = 'templates/ajax/';

    public function __construct() {
        $this->compiler = compiler::getInstance();
        $this->pathToCompiled = (!isset($this->compiler->vars['noAccess'])) ? 
            ($this->compiler->cmpDir . $this->compiler->vars['module'] . '/_ajax_' . $this->compiler->vars['template']. '.tpl') :
            ($this->compiler->cmpDir . $this->compiler->vars['module'] . '/_ajax_noAccess_' . $this->compiler->vars['template']. '.tpl');  
        $this->compiler->tplDir = $this->tplDirAjax;
    }
    
    public function startCompiling() {
        $content = "";
        if (!$this->compiler->recompile && is_file($this->pathToCompiled)) {
            $content = file_get_contents($this->pathToCompiled);
        } else {
            $pathTemplate = DOC_ROOT . $this->compiler->tplDir . $this->compiler->vars['parentmodule'] . '/_' . $this->compiler->vars['parenttemplate'] . '.tpl';
            if (is_file($pathTemplate)) {
                $content = $this->compiler->compile($this->compiler->vars['parentmodule'] . '/_' . $this->compiler->vars['parenttemplate'] . '.tpl' );
                $this->compiler->compilingSave($content, $this->pathToCompiled);
            }
        }
        if ($content != "") {
            $content = $this->compiler->getContents($this->compiler, $content, $this->pathToCompiled);
        }
        
        return $content;
    }

}

