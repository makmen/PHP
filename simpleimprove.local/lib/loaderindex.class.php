<?php
class loaderindex extends loader {
    
    public function __construct() {
        parent::__construct();
        $this->tplDir = 'templates/front/';
    }
    
    public function getTemplate($params) {
        $content = "";
        if (is_file(DOC_ROOT . $this->tplDir . $params['module'] . '/_' . $params['template'] .'.tpl')) {
            if (!isset($this->router->out['noAccess'])) {
                $content = $this->router->display(DOC_ROOT . $this->tplDir . $params['module'] . '/_' . $params['template'] .'.tpl');
            } else {
                $content = $this->router->display(DOC_ROOT . $this->tplDir . '/_noAccess.tpl');
                unset($this->router->out['noAccess']);
            }
        } else {
            $content = 'нет файла шаблона в ' . DOC_ROOT . $this->tplDir . $params['module'] . '/_' . $params['template'] .'.tpl';
        }
        
        return $content;
    }
    
    public function takeIndex($index) {
        $content = "";
        if (is_file(DOC_ROOT . $this->tplDir . $index)) {
            $content = $this->router->display(DOC_ROOT . $this->tplDir . $index );
            if ($content  == '') {
                $content = 'нет файла шаблона в ' . DOC_ROOT . $this->tplDir . $index;
            }
        }
        
        return $content; 
    }


}