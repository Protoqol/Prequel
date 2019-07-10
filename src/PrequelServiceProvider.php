<?php

declare(strict_types = 1);

namespace Protoqol\Prequel;

use Illuminate\Support\ServiceProvider;
use Protoqol\Prequel\Classes\Database\DatabaseTraverser;
use Protoqol\Prequel\Commands;

/**
 * Class PrequelServiceProvider
 *
 * @package Protoqol\Prequel
 */
class PrequelServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(DatabaseTraverser::class, function () {
            return new DatabaseTraverser();
        });

        $this->mergeConfigFrom(
            dirname(__DIR__).'/config/prequel.php',
            'prequel'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(dirname(__DIR__).'/resources/views', 'Prequel');

        $this->loadRoutesFrom(__DIR__.'/Http/routes.php');

        $this->publishes([
            dirname(__DIR__)
            .'/config/prequel.php' => config_path('prequel.php'),
        ], 'prequel-config');

        $this->publishes([
            dirname(__DIR__).'/public' => public_path('vendor/prequel'),
        ], 'prequel-assets');

        $this->commands([
            Commands\UpdateCommand::class,
            Commands\InstallCommand::class,
        ]);
    }
}
