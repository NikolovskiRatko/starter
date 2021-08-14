<?php

namespace App\Applications\Common\Providers;

use App\Applications\Common\BLL\CombinationBLL;
use App\Applications\Common\BLL\CombinationBLLInterface;
use App\Applications\Common\BLL\ParameterBLL;
use App\Applications\Common\BLL\ParameterBLLInterface;
use App\Applications\Common\BLL\ServicesBLL;
use App\Applications\Common\BLL\ServicesBLLInterface;
use App\Applications\Common\BLL\TaxonomiesDAL;
use App\Applications\Common\DAL\ServicesDAL;
use App\Applications\Common\DAL\ServicesDALInterface;
use App\Applications\Common\DAL\TaxonomiesDALInterface;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use App\Applications\Common\DAL\MediaDAL;
use App\Applications\Common\BLL\DashboardBLL;
use App\Applications\Common\BLL\TaxonomiesBLL;
use App\Applications\Common\DAL\MediaDALInterface;
use App\Applications\Common\BLL\DashboardBLLInterface;
use App\Applications\Common\BLL\TaxonomiesBLLInterface;
use App\Applications\Common\BLL\FormatBLL;
use App\Applications\Common\BLL\FormatBLLInterface;
use App\Applications\Common\BLL\ClicheBLL;
use App\Applications\Common\BLL\ClicheBLLInterface;
use App\Applications\Common\BLL\ColorBLL;
use App\Applications\Common\BLL\ColorBLLInterface;
use App\Applications\Common\BLL\HandleBLL;
use App\Applications\Common\BLL\HandleBLLInterface;
use App\Applications\Common\BLL\LaminationBLL;
use App\Applications\Common\BLL\LaminationBLLInterface;
use App\Applications\Common\BLL\PaperBLL;
use App\Applications\Common\BLL\PaperBLLInterface;
use App\Applications\Common\BLL\PackageWeightBLL;
use App\Applications\Common\BLL\PackageWeightBLLInterface;
/*INSERT NEW IMPORTS HERE*/

class CommonServiceProvider extends ServiceProvider
{
    /**
     * Set the service provider namespace
     *
     */
    protected $namespace = 'App\Applications\Common';
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
        $this->app->bind(MediaDALInterface::class, MediaDAL::class);
        $this->app->bind(DashboardBLLInterface::class, DashboardBLL::class);
        $this->app->bind(TaxonomiesBLLInterface::class, TaxonomiesBLL::class);
        $this->app->bind(CombinationBLLInterface::class, CombinationBLL::class);
        $this->app->bind(ParameterBLLInterface::class, ParameterBLL::class);
        $this->app->bind(TaxonomiesDALInterface::class, TaxonomiesDAL::class);
		$this->app->bind(FormatBLLInterface::class, FormatBLL::class);
		$this->app->bind(ClicheBLLInterface::class, ClicheBLL::class);
		$this->app->bind(ColorBLLInterface::class, ColorBLL::class);
		$this->app->bind(HandleBLLInterface::class, HandleBLL::class);
		$this->app->bind(LaminationBLLInterface::class, LaminationBLL::class);
		$this->app->bind(PaperBLLInterface::class, PaperBLL::class);
		$this->app->bind(PackageWeightBLLInterface::class, PackageWeightBLL::class);
        $this->app->bind(ServicesBLLInterface::class, ServicesBLL::class);
        $this->app->bind(ServicesDALInterface::class, ServicesDAL::class);
		/*INSERT NEW BINDINGS HERE*/
    }

    public function map()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/Common/api.php'));
    }

}
