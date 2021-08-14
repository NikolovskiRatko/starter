<?php

namespace App\Applications\Order\Providers;

use App\Applications\Order\BLL\OrderBLL;
use App\Applications\Order\BLL\OrderBLLInterface;
use App\Applications\Order\DAL\OrderDAL;
use App\Applications\Order\DAL\OrderDALInterface;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class OrderServiceProvider extends ServiceProvider
{
    /**
     * Set the service provider namespace
     *
     */
    protected $namespace = 'App\Applications\Order';
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
        $this->app->bind(OrderBLLInterface::class, OrderBLL::class);
        $this->app->bind(OrderDALInterface::class, OrderDAL::class);
    }

    public function map()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/Order/api.php'));
    }

}
