<?php

namespace App\Providers;

use App\Article;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\User' => 'App\Policies\UserManagePolicy',
        'App\Role' => 'App\Policies\RolePolicy',
        'App\Tag' => 'App\Policies\TagPolicy',
        'App\Article' => 'App\Policies\ArticlePolicy',

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

    }
}
