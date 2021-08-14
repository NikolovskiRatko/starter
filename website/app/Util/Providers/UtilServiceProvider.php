<?php

namespace App\Util\Providers;

use App\Util\Helper\HelperService;
use App\Util\Helper\HelperServiceInterface;
use App\Util\MailSender\BLL\SendMailBLL;
use App\Util\MailSender\BLL\SendMailBLLInterface;
use App\Util\Translations\TranslationsRepositoryInterface;
use App\Util\Translations\TranslationsRepository;
use Illuminate\Support\ServiceProvider;

class UtilServiceProvider extends ServiceProvider
{
    /** 
     * Set the service provider namespace
     * 
     */
    protected $namespace = 'App\Util';
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TranslationsRepositoryInterface::class, TranslationsRepository::class);
        $this->app->bind(SendMailBLLInterface::class, SendMailBLL::class);
        $this->app->bind(HelperServiceInterface::class, HelperService::class);
    }


}
