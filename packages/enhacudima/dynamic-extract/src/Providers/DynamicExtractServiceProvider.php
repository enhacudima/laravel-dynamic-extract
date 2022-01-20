<?php
namespace Enhacudima\DynamicExtract\Providers;

use Illuminate\Support\ServiceProvider;

class DynamicExtractServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'extract-view');
        $this->publishes([
            __DIR__.'/../../resources/assets' => public_path('enhacudima/dynamic-extract'),
        ], 'public');

        if ($this->app->runningInConsole()) {

            $this->publishes([
            __DIR__.'/../../config/config.php' => config_path('dynamic-extract.php'),
            ], 'config');

        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__.'/../../routes/web.php';
        $this->mergeConfigFrom(__DIR__.'/../../config/config.php', 'dynamic-extract');
    }
}
