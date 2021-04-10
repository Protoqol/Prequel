<?php

namespace Protoqol\Prequel\Database;

use Exception;
use Illuminate\Database\Connection;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Protoqol\Prequel\Connection\DatabaseConnector;
use Protoqol\Prequel\Traits\classResolver;

/**
 * Class DatabaseTraverser
 *
 * @package Protoqol\Prequel\Database
 */
class DatabaseTraverser
{
    use classResolver;

    /**
     * Type of database e.g. mysql, postgres, sqlite or sql server
     *
     * @var string $databaseConn
     */
    private $databaseConn;

    /**
     * Query collection based on $DB_CONN
     *
     * @var SequelAdapter $databaseQueries
     */
    private $databaseQueries;

    /**
     * Holds custom database connection.
     *
     * @var Connection $connection
     */
    private $connection;

    /**
     * DatabaseTraverser constructor.
     *
     * @param string|null $databaseType
     */
    public function __construct(?string $databaseType = null)
    {
        $this->databaseConn =
            $databaseType ?: config("prequel.database.connection");
        $this->databaseQueries = new SequelAdapter($this->databaseConn);
        $this->connection = (new DatabaseConnector())->getConnection();
    }

    /**
     * Build array of all databases and their respective tables and
     * sort alphabetically.
     *
     * @return array
     * @throws Exception
     */
    public function getAll(): array
    {
        $collection = [];
        $flatTableCollection = [];

        foreach ($this->getAllDatabases() as $value) {
            $databaseName = (object)$value["name"];

            if (
                array_key_exists(
                    $databaseName->official,
                    config("prequel.ignored")
                ) &&
                config("prequel.ignored." . $databaseName->official)[0] === "*"
            ) {
                continue;
            }

            $collection[$databaseName->pretty] = [
                "official_name" => $databaseName->official,
                "pretty_name"   => $databaseName->pretty,
                "tables"        => $this->getTablesFromDB($databaseName->official),
            ];

            foreach (
                $collection[$databaseName->pretty]["tables"]
                as $key => $table
            ) {
                $tablesToIgnore =
                    config("prequel.ignored." . $databaseName->official) ?? [];

                if (
                !in_array($table["name"]["official"], $tablesToIgnore, true)
                ) {
                    $flatTableCollection[] =
                        $databaseName->official .
                        "." .
                        $table["name"]["official"];
                } else {
                    unset($collection[$databaseName->pretty]["tables"][$key]);
                }
            }
        }

        ksort($collection);

        return [
            "collection"          => $collection,
            "flatTableCollection" => $flatTableCollection,
        ];
    }

    /**
     * Tries to find matching model for the given table.
     *
     * @param string|null $tableName
     *
     * @return array|bool Array acts as a tuple containing the actual model and its namespace.
     */
    public function getModel(?string $tableName)
    {
        if (!$tableName) {
            return false;
        }

        $rootNamespace = app()->getNamespace();
        $configNamespace = $this->configNamespaceResolver("model");
        $modelName = Str::studly(Str::singular($tableName));

        foreach (
            ["", "Model\\", "Models\\", $configNamespace->namespace]
            as $subNamespace
        ) {
            $model =
                $rootNamespace .
                $subNamespace .
                $modelName .
                $configNamespace->suffix;

            if (class_exists($model)) {
                return [
                    "model"     => new $model(),
                    "namespace" => $model,
                ];
            }
        }

        return false;
    }

    /**
     * Get information about a specific column
     *
     * @param string $database Database name
     * @param string $table Table name
     * @param array $column Column name
     *
     * @return array
     */
    public function getColumnData(
        string $database,
        string $table,
        array $column
    ): array
    {
        $select = [
            "TABLE_SCHEMA",
            "TABLE_NAME",
            "COLUMN_NAME",
            "COLUMN_DEFAULT",
            "IS_NULLABLE",
            "COLUMN_COMMENT",
        ];

        $result = $this->connection
            ->table("information_schema.COLUMNS")
            ->select($select)
            ->where([
                ["TABLE_SCHEMA", "=", $database],
                ["TABLE_NAME", "=", $table],
                ["COLUMN_NAME", "=", $column],
            ])
            ->get()
            ->toArray();

        return Arr::flatten((array)$result);
    }

    /**
     * Get table structure
     *
     * @param string $database Database name
     * @param string $table Table name
     *
     * @return array*
     */
    public function getTableStructure(string $database, string $table): array
    {
        return $this->connection->getTableStructure($database, $table);
    }

    /**
     * @param string $database Database name
     * @param string $table Table name
     *
     * @return array*
     */
    public function getTableData(string $database, string $table): array
    {
        return $this->connection->getTableData($database, $table);
    }

    /**
     * Get all tables from database
     *
     * @param string $database Database name
     *
     * @return array
     * @throws Exception
     */
    public function getTablesFromDB(string $database): array
    {
        return $this->normalise($this->connection->getTablesFromDB($database));
    }

    /**
     * Get all tables from "main" database (DB_DATABASE in .env)
     *
     * @return array
     * @throws Exception
     */
    public function getAllTables(): array
    {
        $tables = $this->connection->select(
            $this->databaseQueries->showTables()
        );

        return $this->normalise($tables);
    }

    /**
     * Get all databases
     *
     * @return array
     * @throws Exception
     */
    public function getAllDatabases(): array
    {
        $databases = $this->connection->select(
            $this->databaseQueries->showDatabases()
        );

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

        for ($i = 0, $max = count($arr); $i < $max; $i++) {
            foreach ($arr[$i] as $value) {
                if (!$value || !is_string($value)) {
                    continue;
                }

                $arrayValue = Arr::first((array)$value);

                $normalised[$i]["name"] = [
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
        $words = preg_split('/[!@#$%^&*(),.?":{}|<>_-]/', $name);
        $prettyName = "";

        foreach ($words as $iterator => $iteratorValue) {
            $prettyName .= ucfirst(strtolower($iteratorValue));

            if ($iterator !== count($words) - 1) {
                $prettyName .= " ";
                continue;
            }
        }

        return $prettyName;
    }
}
