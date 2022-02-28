<?php

namespace Protoqol\Prequel\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Protoqol\Prequel\Connection\DatabaseConnector;

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
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$this->configurationCheck()->enabled) {
            return response("", 404);
        }

        if (!$this->databaseConnectionCheck()->connected) {
            return response()->view(
                "Prequel::error",
                [
                    "error_detailed" => $this->databaseConnectionCheck()
                        ->detailed,
                    "http_code"      => 503,
                    "env"            => [
                        "connection" => config("prequel.database.connection"),
                        "database"   => config("prequel.database.database"),
                        "host"       => config("prequel.database.host"),
                        "port"       => config("prequel.database.port"),
                        "user"       => config("prequel.database.username"),
                    ],
                    "lang"           => Lang::get(
                        "Prequel::lang",
                        [],
                        (string)config("prequel.locale")
                    ),
                ],
                503
            );
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
        try {
            $conn = (new DatabaseConnector())->getConnection();
            $connection = [
                "connected" => (bool)$conn->getPdo(),
                "detailed"  => $conn->getPdo(),
            ];
        } catch (Exception $exception) {
            dd($exception);
            $connection = [
                "connected" => false,
                "detailed"  => "Could not create a valid database connection.",
            ];
        }

        return (object)$connection;
    }

    /**
     * Check if Prequel is enabled and/or in development
     *
     * @return object
     */
    private function configurationCheck()
    {
        return (object)[
            "enabled"  =>
                config("prequel.enabled") && config("app.env") !== "production",
            "detailed" => "Prequel has been disabled.",
        ];
    }
}
