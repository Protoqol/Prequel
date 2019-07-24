<?php

namespace Protoqol\Prequel\Classes\Database;

use Illuminate\Database\Connection;
use PDO;

/**
 * Class DatabaseConnector
 * @package Protoqol\Prequel\Classes\Database
 */
class DatabaseConnector
{

    public $connection;

    /**
     * @return Connection
     *
     * @throws \Exception
     */
    public function getConnection()
    {
        switch (config('prequel.database.connection')) {
            case 'mysql':
                $className = 'MySql';
                break;
            case 'pgsql':
                $className = 'PostgreSql';
                break;
            default:
                $className = 'error';
                break;
        }

        if($className === 'error') throw new \Exception("Connection couldn't be established due to unsupported database. (".config('prequel.database.connection').")");

        $class = 'Protoqol\\Prequel\\Classes\\Database\\' . $className;

        $this->connection = new Connection((new $class)->getPdo());

        return $this->connection;
    }

    /**
     * @param string $database Database name
     * @return \PDO
     */
    private function getPdo(string $database = '')
    {
        $dsn  = $this->constructDsn($database);
        $user = config('prequel.database.username');
        $pass = config('prequel.database.password');

        return new PDO($dsn, $user, $pass);
    }

    /**
     * @param string $database Database name
     * @return string
     */
    private function constructDsn(string $database = '')
    {
        if(empty($database)){
            $database = config('prequel.database.database');
        }

        $connection = config('prequel.database.connection');
        $host       = config('prequel.database.host');
        $port       = config('prequel.database.port');

        return $connection . ':dbname=' . $database . ';host=' . $host . ';port=' . $port;
    }
}
