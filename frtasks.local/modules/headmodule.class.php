<?php

class HeadModule extends Module {
    
    private $pathCss = '/styles/';
    private $pathJs = '/js/';
    
    private $urlAsset = array();
    private $asset = array();
    
    public function __construct() {
        parent::__construct();
        $this->add('title');
        $this->add('favicon');
        $this->add('meta', null, true);
        $this->add('css', null, true);
        $this->add('js', null, true);
        $this->add('ie', null, true);
        $this->setCondition();
    }

    public function meta($name, $content, $http_equiv) {
        $class = new stdClass();
        $class->name = $name;
        $class->content = $content;
        $class->http_equiv = $http_equiv;
        $this->meta = $class;
    }
    
    public function pathToCss($css) {
        return $this->pathCss . $css;
    }
    public function pathToJs($js) {
        return $this->pathJs . $js;
    }

    public function getTmplFile() {
        return 'head';
    }
    
    private function setCondition() {
        
        $this->urlAsset = array(
            URL::buildUrl('task', 'update') => 'chkAsset',
            URL::buildUrl('task', 'edit') => 'chkAsset',
            URL::buildUrl('task', 'index') => 'chkAsset',
        );
        
        $this->asset = array(
            'chkAsset' => array(
                'css' => array(),
                'js' => array($this->pathToJs('ckeditor/ckeditor.js'))
            ),
        );

    }
    
    public function additionalCondition() {
        $url = URL::buildUrl(URL::$controller, URL::$action);
        if (array_key_exists($url, $this->urlAsset)) {
            if ( isset($this->asset[ $this->urlAsset[$url] ]) ) {
                $this->addCondition( $this->asset[ $this->urlAsset[$url] ] );
            }
        }
    }
    
    private function addCondition($asset) {
        if ( !empty($asset) ) {
            foreach ($asset as $key => $property) {
                if ( !empty($property) ) {
                    foreach ($property as $v) {
                        $this->{$key} = $v;
                    }
                }
            } 
        }
    }

}

