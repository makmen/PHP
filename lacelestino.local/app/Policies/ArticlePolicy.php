<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
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
        return $user->denied('VIEW_ARTICLES');
    }

    public function add(User $user) {
        return $user->denied('ADD_ARTICLES');
    }
    
    public function update(User $user) {
        return $user->denied('UPDATE_ARTICLES');
    }
    
    public function delete(User $user) {
        return $user->denied('DELETE_ARTICLES');
    }
}
