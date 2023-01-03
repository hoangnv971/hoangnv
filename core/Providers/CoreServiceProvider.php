<?php

namespace Core\Providers;

use Illuminate\Support\ServiceProvider;

use Core\Repositories\Contracts\UserRepositoryContract;
use Core\Repositories\UserRepository;
use Core\Services\UserService;
use Core\Services\Contracts\UserServiceContract;

use Core\Repositories\Contracts\RoleRepositoryContract;
use Core\Repositories\RoleRepository;

// use Core\Repositories\Contracts\PermissionRepositoryContract;
// use Core\Repositories\PermissionRepository;

use Core\Services\RoleService;
use Core\Services\Contracts\RoleServiceContract;

class CoreServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(\Core\Modules\ModuleServiceProvider::class);
    }
    
    public function boot()
    {
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
        $this->app->bind(UserServiceContract::class, UserService::class);

        $this->app->bind(RoleRepositoryContract::class, RoleRepository::class);
        $this->app->bind(RoleServiceContract::class, RoleService::class);

        // $this->app->bind(PermissionRepositoryContract::class, PermissionRepository::class);
        // $this->app->bind(PermissionServiceContract::class, PermissionService::class);
    }
}
