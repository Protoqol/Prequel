<?php

declare(strict_types = 1);

namespace Protoqol\Prequel\Classes\Database;

use phpDocumentor\Reflection\Types\Mixed_;
use function PHPSTORM_META\type;
use Protoqol\Prequel\Classes\Database\DatabaseConnector;
use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PDO;

/**
 * Class DatabaseTraverser
 * @package Protoqol\Prequel\Classes\Database
 */
class DatabaseTraverser
{

    /**
     * Type of database e.g. mysql, postgres, sqlite or sql server
     * @var string $databaseConn
     */
    private $databaseConn;

    /**
     * Query collection based on $DB_CONN
     * @var \Protoqol\Prequel\Classes\Database\SequelAdapter $databaseQueries
     */
    private $databaseQueries;

    /**
     * Holds custom database connection.
     * @var \Illuminate\Database\Connection $connection
     */
    private $connection;

    /**
     * DatabaseTraverser constructor.
     *
     * @param string|null $databaseType
     */
    public function __construct(?string $databaseType = null)
    {
        $this->databaseConn    = $databaseType
            ?: config('prequel.database.connection');
        $this->databaseQueries = new SequelAdapter($this->databaseConn);
        $this->connection      = (new DatabaseConnector())->getConnection();
    }

    /**
     * Build array of all databases and their respective tables and
     * sort alphabetically.
     * @return array
     * @throws \Exception
     */
    public function getAll(): array
    {
        $collection          = [];
        $flatTableCollection = [];

        foreach ($this->getAllDatabases() as $value) {
            $databaseName = (object)$value['name'];

            if (array_key_exists($databaseName->official, config('prequel.ignored'))) {
                if (config('prequel.ignored.' . $databaseName->official)[0] === '*') {
                    continue;
                }
            }

            $collection[$databaseName->pretty] = [
                "official_name" => $databaseName->official,
                "pretty_name"   => $databaseName->pretty,
                "tables"        => $this->getTablesFromDB($databaseName->official),
            ];

            foreach ($collection[$databaseName->pretty]['tables'] as $key => $table) {
                $tablesToIgnore = config('prequel.ignored.' . $databaseName->official) ?? [];

                if (array_search($table['name']['official'], $tablesToIgnore) === false) {
                    array_push($flatTableCollection, $databaseName->official . '.' . $table['name']['official']);
                } else {
                    unset($collection[$databaseName->pretty]['tables'][$key]);
                }
            }
        }

        ksort($collection);

        return [
            'collection'          => $collection,
            'flatTableCollection' => $flatTableCollection,
        ];
    }

    /**
     * Tries to find matching model for the given table.
     *
     * @param string|null $tableName
     *
     * @return Model|bool
     */
    public function getModel(?string $tableName)
    {
        if (!$tableName) {
            return false;
        }

        $rootNamespace = app()->getNamespace();
        $modelName     = Str::studly(Str::singular($tableName));

        foreach (['', 'Model\\', 'Models\\'] as $subNamespace) {
            $model = $rootNamespace . $subNamespace . $modelName;
            if (class_exists($model)) {
                return new $model;
            }
        }

        return false;
    }

    /**
     * Get information about a specific column
     *
     * @param string $database Database name
     * @param string $table    Table name
     * @param array  $column   Column name
     *
     * @return array
     */
    public function getColumnData(
        string $database,
        string $table,
        array $column
    ): array {

        $select = [
            'TABLE_SCHEMA',
            'TABLE_NAME',
            'COLUMN_NAME',
            'COLUMN_DEFAULT',
            'IS_NULLABLE',
            'COLUMN_COMMENT',
        ];

        $result = ($this->connection
            ->table("information_schema.COLUMNS")
            ->select($select)
            ->where([
                ['TABLE_SCHEMA', '=', $database],
                ['TABLE_NAME', '=', $table],
                ['COLUMN_NAME', '=', $column],
            ])
            ->get())->toArray();

        return Arr::flatten((array)$result);
    }

    /**
     * Get table structure
     *
     * @param string $database Database name
     * @param string $table    Table name
     *
     * @return array
     */
    public function getTableStructure(string $database, string $table): array
    {
        if ($this->databaseConn === 'pgsql') {
            $columns      = [];
            $connection   = (new DatabaseConnector())->getConnection($database);
            $temp_columns =
                $connection->select("SELECT column_name as field, data_type as type, is_nullable as null, column_default as default FROM information_schema.columns WHERE table_schema='"
                    . config('database.connections.pgsql.schema') . "' AND table_name='" . $table . "'");
            $index        =
                $connection->select("SELECT a.attname FROM pg_index i JOIN pg_attribute a ON a.attrelid = i.indrelid AND a.attnum = ANY(i.indkey) WHERE i.indrelid = '"
                    . $table . "'::regclass AND i.indisprimary;");
            foreach ($temp_columns as $key => $array) {
                if (count($index) > 0 && $array->field === $index[0]->attname) {
                    $array->key     = "PRI";
                    $array->default = null;
                }
                foreach ($array as $column_key => $value) {
                    $columns[$key][ucfirst($column_key)] = $value;
                }
            }
        } else {
            $columns = $this->connection->select("SHOW COLUMNS FROM `$database`.`$table`");
        }

        return $columns;
    }

    /**
     * @param string $database Database name
     * @param string $table    Table name
     *
     * @return array
     */
    public function getTableData(string $database, string $table): array
    {
        $data = [];

        if ($this->databaseConn === 'pgsql') {
            $connection = (new DatabaseConnector())->getConnection($database);
            $data       = $connection->select("SELECT * FROM " . $table);
        } else {
            $data = $this->connection->select("SELECT * FROM `$database`.`$table`");
        }

        return $data;
    }

    /**
     * Get all tables from database
     *
     * @param string $database Database name
     *
     * @return array
     * @throws \Exception
     */
    public function getTablesFromDB(string $database): array
    {
        $tmp = [];

        if ($this->databaseConn === 'pgsql') {
            $connection = (new DatabaseConnector())->getConnection($database);
            $tables     = $connection->select($this->databaseQueries->showTablesFrom($database));

            for ($i = 0; $i < count($tables); $i++) {
                array_push($tmp, $tables[$i]);
            }
            unset($tables);
            $tables = $tmp;
        } else {
            $tables = $this->connection->select($this->databaseQueries->showTablesFrom($database));
        }

        return $this->normalise($tables);
    }

    /**
     * Get all tables from "main" database (DB_DATABASE in .env)
     * @Note Unused
     * @return array
     * @throws \Exception
     */
    public function getAllTables(): array
    {
        $tables = $this->connection->select($this->databaseQueries->showTables());

        return $this->normalise($tables);
    }

    /**
     * Get all databases
     * @return array
     * @throws \Exception
     */
    public function getAllDatabases(): array
    {
        $databases = $this->connection->select($this->databaseQueries->showDatabases());

        return $this->normalise($databases);
    }

    /**
     * Normalise query results; assumes a lot about the structure, which can
     * potentially cause problems later on.
     * Assumed structure:
     *  -----------------
     *  Array [
     *    Object {
     *       'String': Mixed (single value)
     *  -----------------
     *
     * @param array $arr Query results
     *
     * @return array
     */
    public function normalise(array $arr): array
    {
        $normalised = [];

        for ($i = 0; $i < count($arr); $i++) {
            foreach ($arr[$i] as $value) {
                if (!$value || !is_string($value)) {
                    continue;
                }

                $arrayValue = Arr::first((array)$value);

                $normalised[$i]['name'] = [
                    "official" => $arrayValue,
                    "pretty"   => $this->prettifyName($arrayValue),
                ];
            }
        }

        return $normalised;
    }

    /**
     * Prettify names, meaning: remove special characters; capitalise each word.
     *
     * @param string $name
     *
     * @return string
     */
    public function prettifyName(string $name): string
    {
        $words      = preg_split('/[!@#$%^&*(),.?":{}|<>_-]/', $name);
        $prettyName = '';

        for ($iterator = 0; $iterator < count($words); $iterator++) {
            $prettyName .= ucfirst(strtolower($words[$iterator]));

            if ($iterator !== (count($words) - 1)) {
                $prettyName .= ' ';
                continue;
            }
        }

        return $prettyName;
    }
}
