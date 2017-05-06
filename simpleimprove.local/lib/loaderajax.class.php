<?php
class loaderajax extends loader {

    public function __construct() {
        parent::__construct();
        $this->tplDir = 'templates/ajax/';
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
        }
        
        return $content;
    }

}