<?php

declare(strict_types = 1);

namespace Protoqol\Prequel;

use Illuminate\Support\ServiceProvider;
use Protoqol\Prequel\Classes\Database\DatabaseTraverser;
use Protoqol\Prequel\Http\Controllers\DatabaseController;
use Protoqol\Prequel\Http\Requests\PrequelDatabaseRequest;

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

        $this->app->singleton(DatabaseController::class, function ($app) {
            if ($app->runningInConsole()) {
                return new DatabaseController($app['request']);
            }

            return new DatabaseController($app[PrequelDatabaseRequest::class]);
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
            dirname(__DIR__).'/config/prequel.php' => config_path('prequel.php'),
        ], 'config');

        $this->publishes([
            dirname(__DIR__).'/public' => public_path('vendor/prequel'),
        ], 'public');
    }
}
