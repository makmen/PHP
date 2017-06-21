<?php

namespace App\Repositories;

use App\Menu;


class MenuRepository extends Repository {
    
    public function __construct(Menu $model) {
        $this->model = $model;
    }

    public function getMainMenu($select = '*') {
        return $this->getWhere($select, ['user' => 0])->get();
    }
    
}
    