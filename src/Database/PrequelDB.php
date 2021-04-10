<?php

namespace Protoqol\Prequel\Database;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Str;
use PDO;
use Protoqol\Prequel\Connection\DatabaseConnector;

/**
 * Class PrequelDB
 *
 * @package Protoqol\Prequel\Database
 */
class PrequelDB extends Model
{
    /**
     * @var Builder
     */
    protected $builder, $dbConnection;

    /**
     * @param string $database Database name
     * @param string $table Table name
     *
     * @return PrequelDB
     */
    public function create(string $database, string $table)
    {
        $this->dbConnection = (new DatabaseConnector())->getConnection(
            $database
        );
        $tableName = $this->dbConnection->formatTableName($database, $table);
        $this->builder = new Builder(
            $this->dbConnection,
            $this->dbConnection->getGrammar(),
            $this->dbConnection->getProcessor()
        );

        $this->builder->from($tableName);

        return $this;
    }

    /**
     * @return Builder
     */
    public function builder()
    {
        return $this->builder;
    }

    /**
     * @param array $queries
     *
     * @return array
     */
    public function statement(array $queries)
    {
        $queryResponse = [];

        foreach ($queries as $query) {
            if (empty($query)) {
                continue;
            }
            if (Str::startsWith(strtolower($query), "select")) {
                $queryResponse[] = $this->dbConnection
                    ->getPdo()
                    ->query($query)
                    ->fetchAll(PDO::FETCH_ASSOC);
            } elseif (
                Str::startsWith(strtolower($query), "update") ||
                Str::startsWith(strtolower($query), "delete")
            ) {
                $queryResponse[] = $this->dbConnection
                    ->getPdo()
                    ->query($query)
                    ->rowCount();
            } else {
                $queryResponse[] = $this->dbConnection->getPdo()->query($query);
            }
        }

        return $queryResponse;
    }
}
