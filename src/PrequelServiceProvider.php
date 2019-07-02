<?php

declare(strict_types = 1);

/**
 * Protoqol\Prequel\PrequelServiceProvider
 */

namespace Protoqol\Prequel;

use Illuminate\Support\ServiceProvider;
use Protoqol\Prequel\Classes\Database\DatabaseTraverser;

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
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function register()
    {
        $this->app->make('Protoqol\Prequel\Http\Controllers\PrequelController');

        $this->app->singleton(
            DatabaseTraverser::class,
            function () {
                return new DatabaseTraverser();
            }
        );

        $this->loadViewsFrom(dirname(__DIR__).'/resources/views', 'Prequel');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadRoutesFrom(__DIR__.'/Http/routes.php');

        $this->publishes([
            dirname(__DIR__)
            .'/config/prequel.php' => config_path('prequel.php'),
        ],
	'config');

        $this->mergeConfigFrom(
            dirname(__DIR__).'/config/prequel.php',
            'prequel'
        );

        $this->publishes([
                dirname(__DIR__).'/public' => public_path('vendor/prequel'),
            ],
        'public');
    }
}
