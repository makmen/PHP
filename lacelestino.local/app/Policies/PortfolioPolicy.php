<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PortfolioPolicy
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
        return $user->denied('VIEW_PORTFOLIOS');
    }

    public function add(User $user) {
        return $user->denied('ADD_PORTFOLIOS');
    }
    
    public function update(User $user) {
        return $user->denied('UPDATE_PORTFOLIOS');
    }
    
    public function delete(User $user) {
        return $user->denied('DELETE_PORTFOLIOS');
    }
}
