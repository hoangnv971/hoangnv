<?php

namespace Core\Providers;

use Illuminate\Support\ServiceProvider;

use Core\Repositories\Contracts\UserRepositoryContract;
use Core\Repositories\UserRepository;
use Core\Services\UserService;
use Core\Services\Contracts\UserServiceContract;


class CoreServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\Core\Modules\ModuleServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
        $this->app->bind(UserServiceContract::class, UserService::class);

    }
}
