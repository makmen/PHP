<?php

namespace App\Repositories;

use App\User;

class UserRepository extends Repository {
    
    public function __construct(User $model) {
        $this->model = $model;
    }

    public function getUsers() {
        $users = $this->getAll();
        if ( $users ) {
            $users->load('role');
        }
        
        return $users;
    }
    
    public function add($request) {
 
    }
    

    public function update($request, $user) {
        $data = $request->all();
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        if ($user->fill($data)->update()) {
            return ['success' => 'Пользователь изменен'];
        } else {
            return ['error_message' => 'Ошибка работы с базой данных'];
        }
    }
    
    
    public function delete($user) {

    }

    
    
}
    