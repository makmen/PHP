<?php

namespace App\Repositories;

use App\Role;

class RoleRepository extends Repository {
    
    public function __construct(Role $model) {
        $this->model = $model;
    }
    
    public function getRoles() {
        return $this->getAll();
    }
    

}
    