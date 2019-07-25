<?php

namespace Protoqol\Prequel\Classes\Database;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\Grammars\MySqlGrammar;
use Illuminate\Database\Query\Grammars\PostgresGrammar;

class PrequelDB extends Model
{

    /**
     * @param string $database Database name
     * @param string $table Table name
     *
     * @return Builder
     */
    public function create(string $database, string $table)
    {
        $connection = (new DatabaseConnector())->getConnection($database);
        $tableName = $this->connection->formatTableName($database, $table);
        $builder = new Builder($connection, $connection->getGrammar(), $connection->getProcessor());

        $builder->from($tableName);

        return $builder;
    }
}
