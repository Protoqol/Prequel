<?php

namespace Protoqol\Prequel\App;

use FilesystemIterator;
use Illuminate\Support\Facades\Artisan;
use Protoqol\Prequel\Connection\DatabaseConnector;
use Protoqol\Prequel\Interfaces\GenerationInterface;
use Protoqol\Prequel\Traits\classResolver;

/**
 * Class MigrationAction
 *
 * @package Protoqol\Prequel\App
 */
class MigrationAction implements GenerationInterface
{
    use classResolver;

    /**
     * @var string $database
     */
    private $database;

    /**
     * @var string $table
     */
    private $table;

    /**
     * @var $connection
     */
    private $connection;

    /**
     * ControllerAction constructor.
     *
     * @param string $database
     * @param string $table
     */
    public function __construct(string $database, string $table)
    {
        $this->database = $database;
        $this->table = $table;
        $this->connection = (new DatabaseConnector())->getConnection();
    }

    /**
     * @return int
     */
    public function run()
    {
        return Artisan::call("migrate");
    }

    /**
     * @return int
     */
    public function reset()
    {
        return Artisan::call("migrate:reset");
    }

    /**
     * Get total and pending migrations.
     *
     * @return array
     */
    public function pending(): array
    {
        $migrationFileCount = (int)iterator_count(
            new FilesystemIterator(
                database_path("migrations"),
                FilesystemIterator::SKIP_DOTS
            )
        );

        $migrationTableCount = count(
            $this->connection->select("SELECT id FROM migrations;")
        );

        $pending = $migrationFileCount - $migrationTableCount;

        return [
            "pending" => $pending <= 0 ? 0 : $pending,
            "total"   => $migrationFileCount,
        ];
    }

    /**
     * Generate $generator
     *
     * @return mixed
     */
    public function generate()
    {
        // TODO: Implement generate() method.
    }

    /**
     * Get fully qualified class name
     *
     * @return mixed
     */
    public function getQualifiedName()
    {
        // TODO: Implement getQualifiedName() method.
    }

    /**
     * Get class name
     *
     * @return mixed
     */
    public function getClassname()
    {
        // TODO: Implement getClassname() method.
    }

    /**
     * Get class namespace
     *
     * @return mixed
     */
    public function getNamespace()
    {
        // TODO: Implement getNamespace() method.
    }
}
