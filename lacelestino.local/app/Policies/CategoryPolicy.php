<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
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
        return $user->denied('VIEW_CATEGORIES');
    }

    public function add(User $user) {
        return $user->denied('ADD_CATEGORIES');
    }
    
    public function update(User $user) {
        return $user->denied('UPDATE_CATEGORIES');
    }
    
    public function delete(User $user) {
        return $user->denied('DELETE_CATEGORIES');
    }
    
}
