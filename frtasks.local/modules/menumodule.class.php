<?php

class MenuModule extends Module {

    public function __construct() {
        parent::__construct();
        $this->add("auth_user");
        $this->add("server_name");
        $this->add("items", null, true);
    }

    public function getTmplFile() {
        return "menu";
    }

}

