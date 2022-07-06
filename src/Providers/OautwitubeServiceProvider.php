<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 23.07.2018
 * Time: 8:48.
 */

namespace densul\oautwitube\Providers;

use densul\oautwitube\Contracts\Factory;
use densul\oautwitube\OautwitubeManager;
use Illuminate\Support\ServiceProvider;

class OautwitubeServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->registerServices();
    }

    public function boot()
    {
        $this->addConfig();
    }

    private function registerServices()
    {
        $this->app->singleton(Factory::class, function ($app) {
            return new OautwitubeManager($app);
        });
    }

    private function addConfig()
    {
        $this->publishes([
            __DIR__.'/../../config/oautwitube-api.php' => config_path('oautwitube-api.php'),
        ]);
    }

    public function provides()
    {
        return [Factory::class];
    }
}
