<?php

namespace Protoqol\Prequel\Classes\Database;

use Illuminate\Database\Connection;
use PDO;

/**
 * Class DatabaseConnector
 *
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
        $user = config('prequel.DB.USERNAME');
        $pass = config('prequel.DB.PASSWORD');

        return new PDO($dsn, $user, $pass);
    }

    /**
     * @return string
     */
    private function constructDsn()
    {
        $connection   = config('prequel.DB.CONNECTION');
        $databaseName = config('prequel.DB.DATABASE');
        $host         = config('prequel.DB.HOST');

        return $connection.':dbname='.$databaseName.';host='.$host;
    }
}
