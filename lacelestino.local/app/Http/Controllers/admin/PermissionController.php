<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;

use Gate;
use App\Permission;


class PermissionController extends AdminController
{
    
    public function __construct(
        PermissionRepository $permissionRepository, 
        RoleRepository $roleRepository
    ) {
        parent::__construct();
        $this->permissionRepository = $permissionRepository;
        $this->roleRepository = $roleRepository;
    }
    
    
    public function index()
    {
        $this->title = "Менеджер прав пользователей";
        if ( Gate::denies( 'view', new Permission ) ) {
            abort(403);
        }
        $roles = $this->roleRepository->getRoles();
        $permissions = $this->permissionRepository->getPermissions();
        $this->out['content'] = view('admin.permission.content')->
                with([
                    'roles'=>$roles, 
                    'priv' => $permissions, 
                    'denied' => Gate::denies( 'add', new Permission )
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ( Gate::denies( 'add', new Permission ) ) {
            abort(403);
        }
        
        $result = $this->permissionRepository->updatePermissions($request);
        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect('/admin/permissions')->with($result);
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
