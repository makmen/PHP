<?php

abstract class AbstractController {
	
    protected $view;
    protected $request;
    protected $auth_user = null;
    protected $message;
    protected $breadcrumb;

    public function __construct($view, $message) {
        if (!session_id()) {
            session_start();
        }
        $this->view = $view;
        $this->message = $message;
        $this->request = new Request();
        $this->auth_user = User::getAuthUser();
        if (!$this->auth_user &&  URL::buildUrl(URL::$controller) != URL::buildUrl('auth') ) {
            // redirect на авторизацию если пользователь не залогинен
            $this->redirect( Config::SERVER_NAME . '/auth' );
        }
        $this->breadcrumb = new BreadCrumb();
    }

    abstract protected function render($str);

    abstract protected function accessDenied();

    abstract protected function action404();

    protected function access() {
        return true;
    }

    final protected function notFound() {
        $this->action404();
    }

    final protected function redirect($url) {
        header("Location: $url");
        exit;
    }

    final protected function renderData($modules, $layout, $params = array()) {
        if (!is_array($modules))
            return false;
        foreach ($modules as $key => $value) {
            $params[$key] = $value;
        }
        return $this->view->render($layout, $params, true);
    }

}