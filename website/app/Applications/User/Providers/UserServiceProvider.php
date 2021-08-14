<?php

namespace App\Applications\User\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use App\Applications\User\BLL\UserBLL;
use App\Applications\User\DAL\UserDAL;
use App\Applications\User\BLL\UserBLLInterface;
use App\Applications\User\DAL\UserDALInterface;

class UserServiceProvider extends ServiceProvider
{
    /** 
     * Set the service provider namespace
     * 
     */
    protected $namespace = 'App\Applications\User';
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->routesAreCached()) {
         //  This is already done in the main RouteServiceProvider so not needed here
        } else {

            $this->app->call([$this, 'map']);

            $this->app->booted(function () {
                $this->app['router']->getRoutes()->refreshNameLookups();
                $this->app['router']->getRoutes()->refreshActionLookups();
            });
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserDALInterface::class, UserDAL::class);
        $this->app->bind(UserBLLInterface::class, UserBLL::class);
    }

    public function map()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/User/api.php'));
    }

}
