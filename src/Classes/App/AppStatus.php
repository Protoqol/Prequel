<?php


namespace Protoqol\Prequel\Classes\App;

use FilesystemIterator;
use Illuminate\Database\Console\Migrations\MigrateCommand;
use Illuminate\Database\Migrations\Migration;
use Protoqol\Prequel\Classes\Database\DatabaseConnector;
use Protoqol\Prequel\Classes\Database\DatabaseTraverser;

/**
 * Class AppStatus
 *
 * @package Protoqol\Prequel\Classes\App
 */
class AppStatus
{

    /**
     * Holds Prequel's database connection.
     *
     * @var \Illuminate\Database\Connection
     */
    private $connection;

    /**
     * Holds database traverser instance.
     *
     * @var \Protoqol\Prequel\Classes\Database\DatabaseTraverser $traverser
     */
    private $traverser;

    public function __construct()
    {
        $this->traverser  = new DatabaseTraverser();
        $this->connection = (new DatabaseConnector())->getConnection();
    }

    /**
     * @return array
     */
    public function getStatus()
    {
        return [
            'migrations'     => (new Migrations())->pending(),
            'querySpeed'     => $this->querySpeed(),
            'databaseHealth' => $this->databaseHealth(),
        ];
    }

    /**
     * Get current query speed.
     *
     * @return string
     */
    private function querySpeed()
    {
        // Get from Momento::class
        return '234 queries/second';
    }

    /**
     * Check database heatlh.
     *
     * @return string
     */
    private function databaseHealth()
    {
        return 'OK';
    }
}
