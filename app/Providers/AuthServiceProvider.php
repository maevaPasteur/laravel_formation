<?php

namespace App\Providers;

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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('is-admin', function ($user) {
            return $user->role === "admin" && $user->verified === 1;
        });

        Gate::define('is-teacher', function ($user) {
            return $user->role === "teacher" && $user->verified === 1;
        });

        Gate::define('is-student', function ($user) {
            return $user->role === "student" && $user->verified === 1;
        });

        Gate::define('verified', function ($user) {
            return $user->verified === 1;
        });
    }
}
