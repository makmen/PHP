<?php

class router {
    private static $instance;
    private $request;
    private $loader;
    public $mdDir='modules/';
    public $tplDir = 'templates/front/';
    private $index = "_index.tpl";
    private $_404 = "_404.tpl";
    
    public $out = array();
    public $buffer = "";

    private function __construct($request) {
        $this->request = $request;
        $this->out["module"] = $this->request->module;
        $this->out["template"] = $this->request->template;
        $this->out["id"] = $this->request->id;
    }
    
    public static function getInstance($request = null) {
        if (self::$instance === null) {
            self::$instance = new router($request);
        }

        return self::$instance;
    }
  
    // запуск из шаблона
    public function run($module, $template = '', $id = '') {
        $objModule = $this->loadModule($module, $template, $id);
        if ($this->loader === null) {
            $this->loader = loader::factory($this->request->isAjax);
        }
        $content = ($objModule !== null) ?
            $this->loader->getTemplate($objModule->getParamsModule()) :
            "Модуль не найден " . $module;
      
        return $content;
    }

    public function loadModule($module, $template = '', $id = '') {
        $objModule = null;
        if (is_file(DOC_ROOT . $this->mdDir . $module . '/' . $module . '.class.php')) {
            $objModule = new $module($template, $id);
            $objModule->run();
            $this->out = $objModule->getOut(); // выкидываем все в out
        }
        
        return $objModule;
    }
    
    public function show() {
        if ($this->request->module != '') {
            $objModule = $this->loadModule($this->request->module, $this->request->template, $this->request->id);
            if ($objModule !== null) {
                $this->loader = loader::factory($this->request->isAjax);
                $this->out["modulecontent"] = $this->loader->getTemplate($objModule->getParamsModule());
                $this->buffer = $this->loader->takeIndex($this->index);
            } else {
                $this->out['title'] = "Продаем книги в Минске";
                $this->buffer = $this->display( DOC_ROOT . $this->tplDir. $this->_404 );
            }
        } else { // главная страница index
            $this->out['title'] = "Продаем книги в Минске - главная";
            $this->buffer = $this->display( DOC_ROOT . $this-> tplDir. $this->index );
        }
    }
    
    public function display($path) {
        ob_start();
        include($path);
        $content = ob_get_contents();
        ob_end_clean(); 
        
        return $content;
    }

}