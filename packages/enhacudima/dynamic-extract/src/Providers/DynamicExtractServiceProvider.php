<?php
namespace Enhacudima\DynamicExtract\Providers;

use Illuminate\Support\ServiceProvider;
use Enhacudima\DynamicExtract\Console\Commands\InstallCommand;
use Enhacudima\DynamicExtract\Console\Commands\InstallTables;
use Enhacudima\DynamicExtract\Console\Commands\InstallTablesList;
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

        $this->publishes([
            __DIR__.'/../../src/DataBase/Migration' => database_path('migrations')
        ], 'dynamic-extract-migrations');

        if ($this->app->runningInConsole()) {

            $this->publishes([
            __DIR__.'/../../config/config.php' => config_path('dynamic-extract.php'),
            ], 'config');

        }

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
                InstallTables::class,
                InstallTablesList::class,
            ]);
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
