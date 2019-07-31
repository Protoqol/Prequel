<?php

namespace Protoqol\Prequel\Classes\Database;

/**
 * Class DatabaseConnector
 * @package Protoqol\Prequel\Classes\Database
 */
class DatabaseConnector
{

    public $connection;

    /**
     * @param null $database Database name
     * @return mixed
     */
    public function getConnection($database = null)
    {
        switch (config('prequel.database.connection')) {
            case 'mysql':
                $className = 'MySqlConnection';
                break;
            case 'pgsql':
                $className = 'PostgresConnection';
                break;
            default:

                break;
        }

        $class = 'Protoqol\\Prequel\\Classes\\Database\\' . $className;

        if($database) {
            $this->connection = (new $class)->getConnection($database);
        } else {
            $this->connection = (new $class)->getConnection();
        }

        return $this->connection;
    }
}
