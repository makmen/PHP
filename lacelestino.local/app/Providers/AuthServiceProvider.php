<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Permission;
use App\Article;
use App\Portfolio;
use App\User;
use App\Category;
use App\Policies\PermissionPolicy;
use App\Policies\ArticlePolicy;
use App\Policies\PortfolioPolicy;
use App\Policies\UserPolicy;
use App\Policies\CategoryPolicy;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        Permission::class => PermissionPolicy::class,
        Article::class => ArticlePolicy::class,
        Portfolio::class => PortfolioPolicy::class,
        User::class => UserPolicy::class,
        Category::class => CategoryPolicy::class,

    ];

    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
