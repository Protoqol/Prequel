<?php

namespace Protoqol\Prequel\Connection;

use Exception;
use Illuminate\Database\Connection;
use Illuminate\Database\Query\Grammars\PostgresGrammar;
use Illuminate\Database\Query\Processors\PostgresProcessor;
use PDO;
use Protoqol\Prequel\Database\SequelAdapter;

class PostgresConnection extends Connection
{
    protected $connection;

    /**
     * PostgresConnection constructor.
     *
     * @param null $database
     */
    public function __construct($database = null)
    {
        parent::__construct($this->getPdo($database));
        $this->connection = new Connection($this->getPdo($database));
    }

    /**
     * @return PostgresConnection
     */
    public function getConnection()
    {
        return $this;
    }

    /**
     * Called getCustomPdo() so it doesn't override the Connection::getPdo function.
     *
     * @param mixed $database Database name
     *
     * @return PDO
     */
    public function getPdo($database = null)
    {
        $connection = config("prequel.database.connection");
        $host = config("prequel.database.host");
        $port = config("prequel.database.port");
        $database = $database ? $database : config("prequel.database.database");

        $dsn =
            $connection .
            ":dbname=" .
            $database .
            ";host=" .
            $host .
            ";port=" .
            $port;
        $user = config("prequel.database.username");
        $pass = config("prequel.database.password");

        return new PDO($dsn, $user, $pass);
    }

    /**
     * Return with user permissions.
     *
     * @return array
     */
    public function getGrants()
    {
        return (array)$this->select(
            "SELECT grantee, privilege_type FROM information_schema.role_table_grants;"
        )[0];
    }

    /**
     * @return PostgresGrammar
     */
    public function getGrammar()
    {
        return new PostgresGrammar();
    }

    /**
     * @return PostgresProcessor
     */
    public function getProcessor()
    {
        return new PostgresProcessor();
    }

    /**
     * Gets information about the server.
     *
     * @return array
     */
    public function getServerInfo(): array
    {
        $query =
            "select extract(epoch from current_timestamp - pg_postmaster_start_time())";
        $serverInfoArray = [
            "UPTIME" => intval(
                $this->getPdo()
                    ->query($query)
                    ->fetch()[0]
            ),
        ];

        return $serverInfoArray;
    }

    /**
     * @param string $database Database name
     * @param string $table Table name
     *
     * @return string
     */
    public function formatTableName(string $database, string $table): string
    {
        return $table;
    }

    /**
     * @param string $database Database name
     * @param string $table Table name
     *
     * @return array
     */
    public function getTableStructure(string $database, string $table): array
    {
        $columns = [];
        $connection = (new DatabaseConnector())->getConnection($database);
        $temp_columns = $connection->select(
            "SELECT column_name as field, data_type as type, is_nullable as null, column_default as default FROM information_schema.columns WHERE table_schema='" .
            config("database.connections.pgsql.schema") .
            "' AND table_name='" .
            $table .
            "'"
        );
        $index = $connection->select(
            "SELECT a.attname FROM pg_index i JOIN pg_attribute a ON a.attrelid = i.indrelid AND a.attnum = ANY(i.indkey) WHERE i.indrelid = '" .
            $table .
            "'::regclass AND i.indisprimary;"
        );

        foreach ($temp_columns as $key => $array) {
            if (count($index) > 0 && $array->field === $index[0]->attname) {
                $array->key = "PRI";
                $array->default = null;
            }
            foreach ($array as $column_key => $value) {
                $columns[$key][ucfirst($column_key)] = $value;
            }
        }

        return $columns;
    }

    /**
     * @param string $database Database name
     * @param string $table Table name
     *
     * @return array
     */
    public function getTableData(string $database, string $table): array
    {
        $connection = (new DatabaseConnector())->getConnection($database);
        $data = $connection->select("SELECT * FROM " . $table);

        return $data;
    }

    /**
     * @param string $database
     *
     * @return array
     * @throws Exception
     */
    public function getTablesFromDB(string $database): array
    {
        $tables = [];

        $databaseQueries = new SequelAdapter(
            config("prequel.database.connection")
        );
        $connection = (new DatabaseConnector())->getConnection($database);
        $tempTables = $connection->select(
            $databaseQueries->showTablesFrom($database)
        );

        for ($i = 0; $i < count($tempTables); $i++) {
            array_push($tables, $tempTables[$i]);
        }

        return $tables;
    }
}
