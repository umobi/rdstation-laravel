<?php 

namespace Umobi\RDStation;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider {

    protected $package = "rdstation";

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton($this->package, function ($app) {
            $config = $app['config']->get("services.{$this->package}", []);
            return new ApiClient($config);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [$this->package];
    }
}
