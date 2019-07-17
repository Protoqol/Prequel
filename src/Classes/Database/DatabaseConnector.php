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
     * @return \Illuminate\Database\Connection
     */
    public function getConnection()
    {
        $this->connection = (new Connection($this->getPdo()));

        return $this->connection;
    }

    /**
     * @return \PDO
     */
    private function getPdo()
    {
        $dsn  = $this->constructDsn();
        $user = config('prequel.database.username');
        $pass = config('prequel.database.password');

        return new PDO($dsn, $user, $pass);
    }

    /**
     * @return string
     */
    private function constructDsn()
    {
        $connection = config('prequel.database.connection');
        $database   = config('prequel.database.database');
        $host       = config('prequel.database.host');
        $port       = config('prequel.database.port');

        return $connection . ':dbname=' . $database . ';host=' . $host . ';port=' . $port;
    }
}
