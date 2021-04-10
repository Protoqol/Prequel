<?php

namespace Protoqol\Prequel\Database;

use Exception;

/**
 * Get queries based on chosen SQL driver.
 * Class SequelAdapter
 *
 * @package Protoqol\LaravelSequel\Classes\Database
 */
class SequelAdapter
{
    /**
     * Holds database type e.g. 'mysql', 'pgsql', 'sqlite' etc.
     *
     * @var string $databaseType
     */
    private $databaseType;

    /**
     * SequelAdapter constructor.
     *
     * @param string $databaseType
     */
    public function __construct(string $databaseType)
    {
        $this->databaseType = config(
            "database.connections.{$databaseType}.driver"
        );
    }

    /**
     * Get all tables
     *
     * @return string
     * @throws Exception
     */
    public function showTables()
    {
        switch ($this->databaseType) {
            case "mysql":
                return "SHOW TABLES;";
            case "pgsql":
                return 'SELECT table_name FROM information_schema.tables WHERE table_schema=\'' .
                    config("database.connections.pgsql.schema") .
                    '\' ORDER BY table_name;';
            case "sqlite":
                return 'SELECT name FROM sqlite_master WHERE type="table";';
            //            case 'sqlsrv':
            //                return 'SELECT * FROM INFORMATION_SCHEMA.TABLES; GO';
            default:
                throw new Exception(
                    "Selected invalid or unsupported database driver"
                );
        }
    }

    /**
     * @return string
     * @throws Exception
     */
    public function showDatabases()
    {
        switch ($this->databaseType) {
            case "mysql":
                return "SHOW DATABASES;";
            case "pgsql":
                return "SELECT datname FROM pg_database WHERE datistemplate = false;";
            case "sqlite":
                return config("database.connections.sqlte.database");
            default:
                throw new Exception(
                    "Selected invalid or unsupported database driver"
                );
        }
    }

    /**
     * @param string $databaseName
     *
     * @return string
     * @throws Exception
     */
    public function showTablesFrom(string $databaseName)
    {
        switch ($this->databaseType) {
            case "mysql":
                return "SHOW TABLES FROM `" . $databaseName . "`;";
            case "pgsql":
                return 'SELECT table_name FROM information_schema.tables WHERE table_schema=\'' .
                    config("database.connections.pgsql.schema") .
                    '\' ORDER BY table_name;';
            case "sqlite":
                return config("database.connections.sqlte.database");
            default:
                throw new Exception(
                    "Selected invalid or unsupported database driver"
                );
        }
    }
}
