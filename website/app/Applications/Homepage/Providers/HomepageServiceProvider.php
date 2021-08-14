<?php

namespace App\Applications\Homepage\Providers;

use App\Applications\Homepage\BLL\HomepageBLL;
use App\Applications\Homepage\BLL\HomepageBLLInterface;
use App\Applications\Homepage\DAL\HomepageDAL;
use App\Applications\Homepage\DAL\HomepageDALInterface;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use App\Applications\User\BLL\UserBLL;
use App\Applications\User\DAL\UserDAL;
use App\Applications\User\BLL\UserBLLInterface;
use App\Applications\User\DAL\UserDALInterface;

class HomepageServiceProvider extends ServiceProvider
{
    /**
     * Set the service provider namespace
     *
     */
    protected $namespace = 'App\Applications\Homepage\Controllers';
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
        $this->app->bind(HomepageDALInterface::class, HomepageDAL::class);
        $this->app->bind(HomepageBLLInterface::class, HomepageBLL::class);
    }

    public function map()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/Homepage/api.php'));
    }

}
