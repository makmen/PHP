<?php

class BreadCrumb extends Module {
    
    public $breadCrumbTitle = array( );
    
    public function __construct() {
        parent::__construct();
        $this->add("data", null, true);
        $this->fillTitleDefault();
        $this->addIndex();
    }
    
    private function addIndex() {
        $this->addData("Главная", Config::SERVER_NAME);
    }

    public function addData($title, $link = false) {
        $obj = new stdClass();
        $obj->title = $title;
        $obj->link = $link;
        $this->data = $obj;
    }
    
    public function setDefault($url) {
        if (array_key_exists($url, $this->breadCrumbTitle)) {
            $this->addData($this->breadCrumbTitle[$url], $url);
        }
    }
    
    private function fillTitleDefault() {
        $this->breadCrumbTitle = array(
            URL::buildUrl('project', 'index') => "Проекты",
            URL::buildUrl('task', 'view') => "Задачи",
            URL::buildUrl('auth', 'view') => "Пользователи",
            URL::buildUrl('permission', 'index') => "Привелегии",
        );
    }

    public function getTmplFile() {
        return "breadcrumb";
    }

}