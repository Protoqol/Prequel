<?php

namespace Protoqol\Prequel;

use Illuminate\Support\ServiceProvider;
use Protoqol\Prequel\Commands;
use Protoqol\Prequel\Database\DatabaseTraverser;
use Protoqol\Prequel\Database\PrequelDB;
use Protoqol\Prequel\Http\Controllers\DatabaseController;
use Protoqol\Prequel\Http\Requests\PrequelDatabaseRequest;

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
    public function register(): void
    {
        $this->app->singleton(DatabaseTraverser::class, function () {
            return new DatabaseTraverser();
        });

        $this->app->bind("prequeldb", function () {
            return new PrequelDB();
        });

        $this->app->singleton(DatabaseController::class, function ($app) {
            if ($app->runningInConsole()) {
                return new DatabaseController($app["request"]);
            }

            return new DatabaseController($app[PrequelDatabaseRequest::class]);
        });

        $this->mergeConfigFrom(
            dirname(__DIR__) . "/config/prequel.php",
            "prequel"
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadViewsFrom(dirname(__DIR__) . "/resources/views", "Prequel");

        $this->loadRoutesFrom(__DIR__ . "/Http/routes.php");

        $this->loadTranslationsFrom(
            dirname(__DIR__) . "/resources/lang/",
            "Prequel"
        );

        $this->publishes(
            [
                dirname(__DIR__) . "/resources/lang" => resource_path(
                    "lang/vendor/prequel"
                ),
            ],
            "prequel-lang"
        );

        $this->publishes(
            [
                dirname(__DIR__) . "/config/prequel.php" => config_path(
                    "prequel.php"
                ),
            ],
            "prequel-config"
        );

        $this->publishes(
            [
                dirname(__DIR__) . "/public" => public_path("vendor/prequel"),
            ],
            "prequel-assets"
        );

        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\UpdateCommand::class,
                Commands\InstallCommand::class,
            ]);
        }
    }
}
