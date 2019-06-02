<?php

    namespace Protoqol\Prequel;

    use Illuminate\Support\ServiceProvider;

    class PrequelServiceProvider extends ServiceProvider {

        /**
         * Register services.
         *
         * @return void
         * @throws \Illuminate\Contracts\Container\BindingResolutionException
         */
        public function register() {

            $this->app->make('Protoqol\Prequel\Http\Controllers\PrequelController');
            $this->loadViewsFrom(dirname(__DIR__).'/resources/views', 'LaravelSequel');

        }

        /**
         * Bootstrap services.
         *
         * @return void
         */
        public function boot() {

            $this->loadRoutesFrom(__DIR__.'/Http/routes.php');

            $this->publishes([
                dirname(__DIR__).'/config/prequel.php' => config_path('prequel.php'),
            ]);

            $this->mergeConfigFrom(dirname(__DIR__).'/config/prequel.php', 'prequel');

            $this->publishes([
                dirname(__DIR__).'/public' => public_path('vendor/prequel'),
            ], 'prequel-assets');
        }
    }
