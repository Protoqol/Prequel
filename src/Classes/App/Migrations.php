<?php


namespace Protoqol\Prequel\Classes\App;

use FilesystemIterator;
use Illuminate\Support\Facades\Artisan;
use Protoqol\Prequel\Classes\Database\DatabaseConnector;

/**
 * Class Migrations
 *
 * @package Protoqol\Prequel\Classes\App
 */
class Migrations
{

    private $connection;

    public function __construct()
    {
        $this->connection = (new DatabaseConnector())->getConnection();
    }

    /**
     * @return int
     */
    public function run()
    {
        return Artisan::call('migrate');
    }

    /**
     * @return int
     */
    public function reset()
    {
        return Artisan::call('migrate:reset');
    }

    /**
     * Get total and pending migrations.
     *
     * @return array
     */
    public function pending() :array
    {
        $migrationFileCount = (int)iterator_count(new FilesystemIterator(
            database_path('migrations'),
            FilesystemIterator::SKIP_DOTS
        ));

        if(config('prequel.database.connection') === "pgsql"){
            $migrationTableCount = count($this->connection->select('SELECT id FROM migrations;'));
        } else {
            $migrationTableCount = count($this->connection->select('SELECT `id` FROM `migrations`;'));
        }

        $pending = $migrationFileCount - $migrationTableCount;

        return [
            'pending' => $pending <= 0 ? 0 : $pending,
            'total'   => $migrationFileCount,
        ];
    }
}
