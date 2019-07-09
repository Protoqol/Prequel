<?php

declare(strict_types = 1);

namespace Protoqol\Prequel\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

/**
 * Class Authorised
 *
 * @package Protoqol\Prequel\Http\Middleware
 */
class Authorised
{

    /**
     * Handle an incoming request.
     * Checks if Prequel is enabled and has a valid database connection.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$this->configurationCheck()->enabled) {
            return view('Prequel::error', [
                'error_detailed' => $this->configurationCheck()->detailed,
                'http_code'      => 403,
                'env'            => [
                    'connection' => 'protected',
                    'database'   => 'protected',
                    'host'       => 'protected',
                    'port'       => 'protected',
                    'user'       => 'protected',
                ],
            ]);
        }

        if (!$this->databaseConnectionCheck()->connected) {
            return view('Prequel::error', [
                'error_detailed' => $this->databaseConnectionCheck()->detailed,
                'http_code'      => 503,
                'env'            => [
                    'connection' => config('prequel.DB.CONNECTION'),
                    'database'   => config('prequel.DB.DATABASE'),
                    'host'       => config('prequel.DB.HOST'),
                    'port'       => config('prequel.DB.PORT'),
                    'user'       => config('prequel.DB.USERNAME'),
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
    private function databaseConnectionCheck()
    {
        $connection = [];

        try {
            $connection = [
                'connected' => (bool) DB::connection()->getPdo(),
                'detailed'  => DB::connection()->getPdo(),
            ];
        } catch (\Exception $exception) {
            $connection = [
                'connected' => false,
                'detailed'  => 'No valid database connection',
            ];
        }

        return (object) $connection;
    }

    /**
     * Check if Prequel is enabled and/or in development
     *
     * @return object
     */
    private function configurationCheck()
    {
        return (object) [
            'enabled'  => (config('prequel.enabled')
                && config('app.env') !== 'production'),
            'detailed' => 'Prequel has been disabled.',
        ];
    }
}
