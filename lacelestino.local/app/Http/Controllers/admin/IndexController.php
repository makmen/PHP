<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;


class IndexController extends AdminController
{
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $this->title = 'Панель администратора';

        $this->out['content'] = view('admin.content')->render();
        
        return $this->renderOutput();
    }
}
