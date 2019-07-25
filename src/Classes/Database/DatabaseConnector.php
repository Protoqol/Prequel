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
        $className = ucfirst(config('prequel.database.connection')) . 'Connection';
        $class = 'Protoqol\\Prequel\\Classes\\Database\\' . $className;

        if($database) {
            $this->connection = (new $class)->getConnection($database);
        } else {
            $this->connection = (new $class)->getConnection();
        }

        return $this->connection;
    }
}
