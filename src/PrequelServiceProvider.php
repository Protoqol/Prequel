<?php

    namespace Protoqol\Prequel;

    use Illuminate\Support\ServiceProvider;
    use Protoqol\Prequel\Classes\Database\DatabaseTraverser;

    class PrequelServiceProvider extends ServiceProvider {

        /**
         * Register services.
         *
         * @return void
         * @throws \Illuminate\Contracts\Container\BindingResolutionException
         */
        public function register() {

            // Make controller
            $this->app->make('Protoqol\Prequel\Http\Controllers\PrequelController');

            // DatabaseTraverser singleton
            $this->app->singleton(DatabaseTraverser::class, function ($app) {
                return new DatabaseTraverser();
            });

            // Load views
            $this->loadViewsFrom(dirname(__DIR__).'/resources/views', 'Prequel');

        }

        /**
         * Bootstrap services.
         *
         * @return void
         */
        public function boot() {

            // Load routes
            $this->loadRoutesFrom(__DIR__.'/Http/routes.php');

            // Publish config
            $this->publishes([
                dirname(__DIR__).'/config/prequel.php' => config_path('prequel.php'),
            ]);

            // Merge config if already exists
            $this->mergeConfigFrom(dirname(__DIR__).'/config/prequel.php', 'prequel');

            // Publish assets, app.js - app.cs - favicon.png - mix-manifest.json
            $this->publishes([
                dirname(__DIR__).'/public' => public_path('vendor/prequel'),
            ], 'prequel-assets');
        }
    }
