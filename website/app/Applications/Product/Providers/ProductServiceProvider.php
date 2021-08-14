<?php

namespace App\Applications\Product\Providers;

use App\Applications\Product\BLL\PriceConfigurator;
use App\Applications\Product\BLL\PriceConfiguratorInterface;
use App\Applications\Product\BLL\ProductBLL;
use App\Applications\Product\BLL\ProductBLLInterface;
use App\Applications\Product\DAL\OfferDAL;
use App\Applications\Product\DAL\OfferDALInterface;
use App\Applications\Product\DAL\ProductDAL;
use App\Applications\Product\DAL\ProductDALInterface;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * Set the service provider namespace
     *
     */
    protected $namespace = 'App\Applications\Product';
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
        $this->app->bind(ProductBLLInterface::class, ProductBLL::class);
        $this->app->bind(ProductDALInterface::class, ProductDAL::class);
        $this->app->bind(OfferDALInterface::class, OfferDAL::class);
        $this->app->bind(PriceConfiguratorInterface::class, PriceConfigurator::class);
    }

    public function map()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/Product/api.php'));
    }

}
