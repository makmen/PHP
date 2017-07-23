<?php

abstract class Controller extends AbstractController {

    protected $title;
    protected $meta_desc;
    protected $meta_key;
    protected $out = [];
    protected $mail = null;
    protected $url_active;

    public function __construct() {
        parent::__construct(
                new View(Config::DIR_TMPL), new Message(Config::FILE_MESSAGES)
        );
        $this->mail = new Mail();
    }

    public static function createController($name) {
        return new $name();
    }

    public function action404() {
        header("HTTP/1.1 404 Not Found");
        header("Status: 404 Not Found");
        $this->title = "Страница не найдена - 404";
        $this->meta_desc = "Запрошенная страница не существует.";
        $this->meta_key = "страница не найдена, страница не существует, 404";

        $this->out['titlePage'] = "Страница не найдена";
        $this->out['text'] = "К сожалению, запрошенная страница не существует. Проверьте правильность ввода адреса.";

        $this->render("errors/index");
    }

    protected function accessDenied($text = '') {
        $this->title = "Доступ закрыт!";
        $this->meta_desc = "Доступ к данной странице закрыт.";
        $this->meta_key = "доступ закрыт, доступ закрыт страница, доступ закрыт страница 403";

        $this->out['titlePage'] = "Доступ закрыт!";
        $this->out['text'] = ($text == '') ? "У Вас нет прав доступа к данной странице." : $text;

        $this->render("errors/index");
    }

    final protected function render($actionLayout) {
        $params = array();
        $params["content"] = $this->view->render($actionLayout, $this->out, true);
        $params["titlePage"] = $this->out['titlePage'];
        $params["project"] = (isset($_SESSION["project"])) ? Project::getSessionProject()['title'] : '';
        $user = User::getAuthUser();
        $params["auth"] = ($user) ? $user['name'] . ' (' . $user['role_name'] . ')' : '';
        $params["head"] = $this->getHead();
        $params["menu"] = $this->getMenu();
        $params["breadcrumb"] = $this->breadcrumb;

        $this->view->render(Config::LAYOUT, $params);
    }

    protected function getHead() {
        $head = new HeadModule();
        $head->title = $this->title;
        $head->meta("Content-Type", "text/html; charset=utf-8", true);
        $head->meta("description", $this->meta_desc, false);
        $head->meta("keywords", $this->meta_key, false);
        $head->meta("viewport", "width=device-width", false);

        $head->favicon = "/favicon.ico";
        $head->css = array(
            $head->pathToCss("reset.css"), $head->pathToCss("style.css"), $head->pathToCss("skin.css")
        );
        $head->js = array(
            $head->pathToJs("jquery-3.1.1.min.js")
        );
        $head->ie = array('IE 7' => $head->pathToCss("ie7.css"), 'IE 8' => $head->pathToCss("ie8.css"));
        $head->additionalCondition();

        return $head;
    }

    protected function getMenu() {
        if (!$this->auth_user) {
            return "";
        }
        $menu = new MenuModule();
        $menu->auth_user = $this->auth_user;
        $menu->server_name = Config::SERVER_NAME;
        Menu::getMainMenu($menu);

        return $menu;
    }

    final private function getOffset($page, $onPage) {
        return $onPage * ($page - 1);
    }

    final private function getPage() {
        $page = (int) $this->request->page;

        return ($page > 0) ? $page : 1;
    }

    final protected function getPagination($total, $onPage, $url) {
        $active = $this->getPage();
        $totalPages = ceil($total / $onPage);

        $pagination = new Pagination();
        $pagination->total = $total;
        $pagination->on_page = $onPage;
        $pagination->active = $active;
        $pagination->offset = $this->getOffset($active, $onPage);
        $pagination->lastPage = $totalPages;

        if ($pagination->lastPage > 1 && $active <= $pagination->lastPage) {
            $url = URL::deleteGET($url, $pagination->patern);
            for ($i = $pagination->firstPage; $i <= $pagination->lastPage; $i++) {
                $pagination->url = URL::addGET($url, $pagination->patern, $i);
            }
            $params['pagination'] = $pagination;
            $pagination->setRender($this->view->render($pagination->getTmplFile(), $params, true));
        }

        return $pagination;
    }

}
