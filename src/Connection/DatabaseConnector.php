<?php

namespace Protoqol\Prequel\Connection;

/**
 * Class DatabaseConnector
 *
 * @package Protoqol\Prequel\Database
 */
class DatabaseConnector
{
    public $connection;

    /**
     * @param  null  $database  Database name
     *
     * @return mixed
     */
    public function getConnection($database = null)
    {
        $presumed = config("prequel.database.connection");

        switch ($presumed) {
            case "mysql":
                $className = "MySqlConnection";
                break;
            case "pgsql":
                $className = "PostgresConnection";
                break;
            default:
                $className = "MySqlConnection";
                break;
        }

        if (!isset($className)) {
            $presumedCustomConnectionName = config("database.connections.{$presumed}.driver");

            switch ($presumedCustomConnectionName) {
                case "mysql":
                    $className = "MySqlConnection";
                    break;
                case "pgsql":
                    $className = "PostgresConnection";
                    break;
                default:
                    break;
            }
        }


        $class = "Protoqol\\Prequel\\Connection\\" . $className;

        if ($database) {
            $this->connection = (new $class())->getConnection($database);
        } else {
            $this->connection = (new $class())->getConnection();
        }

        return $this->connection;
    }
}
