<?php

namespace Protoqol\Prequel\Classes\Database;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\Grammars\MySqlGrammar;
use Illuminate\Database\Query\Grammars\PostgresGrammar;

/**
 * Class PrequelDB
 * @package Protoqol\Prequel\Classes\Database
 */
class PrequelDB extends Model
{

    /**
     * @param string $database Database name
     * @param string $table    Table name
     *
     * @return Builder
     */
    public function create(string $database, string $table)
    {
        $tableName = $database . "." . $table;

        if (config('prequel.database.connection') === "pgsql") {
            $connection = (new DatabaseConnector())->getConnection($database);
            $grammar    = new PostgresGrammar();
            $tableName  = $table;
        } else {
            $connection = (new DatabaseConnector())->getConnection();
            $grammar    = new MySqlGrammar();
        }

        $builder = new Builder($connection, $grammar);

        $builder->from($tableName);

        return $builder;
    }
}
