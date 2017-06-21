<?php

namespace App\Repositories;

use App\Permission;
use App\Repositories\RoleRepository;

class PermissionRepository extends Repository {
    protected $roleRepository;
    
    public function __construct(Permission $model, RoleRepository $roleRepository) {
        $this->model = $model;
        $this->roleRepository = $roleRepository;
    }

    public function getPermissions() {
        return $this->getAll();
    }
    
    public function updatePermissions($request) {
        $data = $request->except('_token');
        $roles = $this->roleRepository->getRoles();

        foreach ($roles as $role) {
            if (isset($data[$role->id])) {
                $role->savePermissions($data[$role->id]);
            } else {
                $role->savePermissions([]);
            }
        }

        return ['status' => 'Права обновлены'];
    }

}
    