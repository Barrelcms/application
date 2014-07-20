<?php namespace Barrel\Providers;

use Illuminate\Support\ServiceProvider;

class BarrelServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('barrelcms/application', 'barrel');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    /**
     * Register application routes.
     *
     * @return void
     */
    public function routes()
    {
        foreach (File::allFiles(__DIR__.'/../../routes/') as $routes) {
            require_once $routes->getPathName();
        }
    }

}