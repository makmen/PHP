<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\UserRepository;
use App\User;
use Auth;

class UserController extends AdminController
{
    
    public function __construct( UserRepository $userRepository ) {
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->dirResource = 'user';
    }

    public function index(Request $request)
    {
        $this->title = 'Изменение данных пользователя';
        $user = Auth::user();
        $result = false;
        if ($request->isMethod('post')) {
            
            $messages = [
                'required' => 'Поле :attribute обязательно к заполнению',
                'email' => 'Поле :attribute должно содержать правильный email адрес',
                'unique' => 'Поле :attribute уже существует в базе данных',
                'min' => 'Поле :attribute должно содержать не менее 6 символов',
                'confirmed' => 'Поле :attribute должно совпадать',
            ];
            
            $this->validate($request, [
                'name' => 'required|max:255',
                'login' => 'required|max:255|unique:users,login,' . $user->id,
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6'
            ] ,$messages );
            
            $result = $this->userRepository->update($request, $user);
            if(is_array($result) && !empty($result['error_message'])) {
                return back()->with($result);
            }
        }
        $this->out['content'] = view( 'admin.' . $this->dirResource.'.update')->
            with( [
                'user' => $user, 
                'success' => $result['success']    
            ] )->render();
        
        return $this->renderOutput();
    }

}
