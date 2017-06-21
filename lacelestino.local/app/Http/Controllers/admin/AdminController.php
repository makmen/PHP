<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AppController;

use Auth;
use LavaryMenu;

class AdminController extends Controller {

    protected $title;
    protected $out;
    protected $template;
    
    
    public function __construct() {
        $this->template = 'admin.index';
    }

    public function renderOutput() {
        $this->out['title'] = $this->title;
        $appController = new AppController(
            new \App\Repositories\MenuRepository(new \App\Menu)
        );
        $this->out['navigation'] =  view('index.navigation')->
            with('menu', $appController->buildMenu() )->render();
        
        $this->out['adminNavigation'] = view('admin.navigation')->
                with('menu', $this->getMenu() )->render();

        return view($this->template)->with($this->out);
    }

    public function getMenu() {
        return LavaryMenu::make('adminMenu', function($menu) {
            $menu->add('Категории', array('route' => 'categories.index'));
            $menu->add('Статьи', array('route' => 'articles.index'));
            $menu->add('Портфолио', array('route' => 'portfolios.index'));
            $menu->add('Пользователи', array('route' => 'users.index'));
            $menu->add('Привилегии', array('route' => 'permissions.index'));
            $menu->add('Выход', array('route' => 'logout'));
        });
    }

}
