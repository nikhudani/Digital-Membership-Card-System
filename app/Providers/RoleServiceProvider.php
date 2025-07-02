<?php

namespace App\Providers;

use App\Models\Roles\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class RoleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('roleHas', function(...$roles){
            return in_array(ucfirst(auth()->user()->role->name), array_map('ucfirst', $roles));
        });
    }
}
