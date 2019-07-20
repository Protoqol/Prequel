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
     * @param string $database Database name
     * @return Connection
     */
    public function getConnection(string $database = '')
    {
        $this->connection = (new Connection($this->getPdo($database)));

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
