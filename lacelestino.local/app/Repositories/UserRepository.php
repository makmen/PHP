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
    
    public function addUser($request) {
        $data = $request->all();
        
        $user = $this->model->create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'login' => $data['login'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
            'role_id' => $data['role_id'],
        ]);
        
        if ($user) {
            return ['status' => 'Пользователь добавлен'];
        } else {
            return ['error' => 'Ошибка сохранения в базу данных'];
        }
    }
    
    public function updateUser($request, $user) {
        $data = $request->all();

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        if ( $user->fill($data)->update() ) {
            return ['status' => 'Пользователь изменен '];
        } else {
            return ['error' => 'Ошибка сохранения в базу данных'];
        }
    }

    public function deleteUser($user) {
        if ($user->delete()) {
            return ['status' => 'Пользователь удален'];
        }
    }
    
    
}
    