<?php

class Route {
 
    public static function start() {
        Request::inst();
        $ca_names = URL::getControllerAndAction();
        $controllerName = $ca_names[0] . "Controller";
        $actionName = "action" . $ca_names[1];
        $controller = null;

        try {

            if (class_exists($controllerName)) {
                $controller = Controller::createController($controllerName);
            } else {
                $controller = Controller::createController(Config::DEFAULT_CONTROLLER . "Controller");
                throw new Exception();
            }

            if (method_exists($controller, $actionName)) {
                $controller->$actionName();
            } else {
                throw new Exception();
            }
            
        } catch (Exception $e) {

            if ($e->getMessage() != "ACCESS_DENIED") {
                $controller->action404();
            }
            
        }
        
    }

    
}