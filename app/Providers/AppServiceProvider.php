<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->bind('App\Repositories\Contracts\UserRepositoryInterface','App\Repositories\Eloquent\UserRepository');//1º qual interface vai definir
      $this->app->bind('App\Repositories\Contracts\PermissionRepositoryInterface',
      'App\Repositories\Eloquent\PermissionRepository');
      $this->app->bind('App\Repositories\Contracts\RoleRepositoryInterface',
      'App\Repositories\Eloquent\RoleRepository');
      //2º qual a classe que essa interface vai receber uma instancia

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }
}
