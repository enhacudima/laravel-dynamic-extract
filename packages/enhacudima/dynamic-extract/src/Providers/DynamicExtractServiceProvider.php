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
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__.'/../../routes/web.php';
    }
}
