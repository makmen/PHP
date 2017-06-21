<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
    public function view(User $user) {
        return $user->denied('VIEW_PERMISSIONS');
    }
    
    public function add(User $user) {
        return $user->denied('ADD_PERMISSIONS');
    }
    
}
