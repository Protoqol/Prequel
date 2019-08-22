<?php
    
    namespace Protoqol\Prequel\Database;
    
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Query\Builder;
    use Protoqol\Prequel\Connection\DatabaseConnector;
    
    /**
     * Class PrequelDB
     * @package Protoqol\Prequel\Database
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
            $connection = (new DatabaseConnector())->getConnection($database);
            $tableName  = $connection->formatTableName($database, $table);
            $builder    = new Builder($connection, $connection->getGrammar(), $connection->getProcessor());
            
            $builder->from($tableName);
            
            return $builder;
        }
    }
