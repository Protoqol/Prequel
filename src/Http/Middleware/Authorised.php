<?php

    namespace Protoqol\Prequel\Http\Middleware;

    use Closure;
    use Illuminate\Support\Facades\DB;

    class Authorised {

        /**
         * Handle an incoming request.
         * Checks if Prequel is enabled and has a valid database connection.
         *
         * @param \Illuminate\Http\Request $request
         * @param \Closure                 $next
         *
         * @return mixed
         */
        public function handle($request, Closure $next) {
            if (!$this->configurationCheck()->enabled) {

                return view('Prequel::error', [
                    'error_detailed' => $this->configurationCheck()->detailed,
                    'http_code'      => 403,
                    'env'            => [
                        'database' => env('DB_DATABASE'),
                        'host'     => env('DB_HOST'),
                        'port'     => env('DB_PORT'),
                        'user'     => env('DB_USERNAME'),
                    ],
                ]);

            }

            if (!$this->databaseConnectionCheck()->connected) {

                return view('Prequel::error', [
                    'error_detailed' => $this->databaseConnectionCheck()->detailed,
                    'http_code'      => 503,
                    'env'            => [
                        'database' => env('DB_DATABASE'),
                        'host'     => env('DB_HOST'),
                        'port'     => env('DB_PORT'),
                        'user'     => env('DB_USERNAME'),
                    ],
                ]);

            }

            return $next($request);
        }

        /**
         * Check connection with database
         *
         * @return object
         */
        private function databaseConnectionCheck() {
            $connection = [];

            try {
                $connection = [
                    'connected' => (bool)DB::connection()->getPdo(),
                    'detailed'  => DB::connection()->getPdo(),
                ];
            }
            catch (\Exception $e) {
                $connection = [
                    'connected' => false,
                    'detailed'  => 'No valid database connection',
                ];
            }

            return (object)$connection;
        }

        /**
         * Check if Prequel is enabled and/or in development
         *
         * @return object
         */
        private function configurationCheck() {
            return (object)[
                'enabled'  => (!config('prequel.enabled') || config('app.env') !== 'production'),
                'detailed' => [
                    'prequelEnabled' => config('prequel.enabled'),
                    'inProduction'   => (config('app.env') === 'production'),
                ],
            ];
        }
    }
