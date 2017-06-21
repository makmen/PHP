<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Http\Requests\UserRequest;

use App\User;
use Gate;

class UserController extends AdminController
{

    public function __construct(
        RoleRepository $roleRepository, 
        UserRepository $userRepository
    ) {
        parent::__construct();

        $this->roleRepository = $roleRepository;
        $this->userRepository = $userRepository;
    }
    
    public function index()
    {
        $this->title = 'Пользователи системы';
        if ( Gate::denies( 'view', new User ) ) {
            abort(403);
        }
        $this->out['content'] = view('admin.user.content')->
            with([
                'users' => $this->userRepository->getUsers(),
                'denied' => Gate::denies('add', new User)
            ])->render();

        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ( Gate::denies( 'add', new User ) ) {
            abort(403);
        }
        $this->title = 'Новый пользователь';
        $roles = $this->roleRepository->getRoles();
        $lists = [];
        foreach ($roles as $role) {
            $lists[$role['id']] =  $role['name'];
        }
        $this->out['content'] = view('admin.user.create')->
                with(['roles' =>$lists])->render();
        
        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if ( Gate::denies( 'add', new User ) ) {
            abort(403);
        }
        $result = $this->userRepository->addUser($request);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        
        return redirect('/admin/users')->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {        
        if ( Gate::denies( 'update', new User ) ) {
            abort(403);
        }
        $this->title =  'Редактирование пользователя - '. $user->name;
        $roles = $this->roleRepository->getRoles();
        $lists = [];
        foreach ($roles as $role) {
            $lists[$role['id']] =  $role['name'];
        }

        $this->out['content'] = view('admin.user.create')->with(['roles'=>$lists, 'user'=>$user])->render();

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        if ( Gate::denies( 'update', new User ) ) {
            abort(403);
        }
        $result = $this->userRepository->updateUser($request,$user);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        
        return redirect('/admin/users')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ( Gate::denies( 'delete', new User ) ) {
            abort(403);
        }
        $result = $this->userRepository->deleteUser($user);
        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        
        /* 
         * Доработать чтобы удалял статьи которые разместил пользователь и коменты для этих статей
         */
        
        return redirect('/admin/users')->with($result);
    }
}
