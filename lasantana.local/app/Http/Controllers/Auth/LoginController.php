<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Validator;
use App\User;
use App\Http\Controllers\AppController;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'login' => 'required|max:255',
            'password' => 'required|min:6|confirmed',
        ]);
    }
    
    public function showLoginForm()
    {
        $appController = new AppController( );
        $navigation = view('index.navigation')->
            with([
                'menu' => $appController->buildMenu()
            ])->render();
        
        return view( 'admin.login' )->with([
            'title' => 'Вход на сайт',
            'navigation' => $navigation
        ]);
    }
    
    
}
