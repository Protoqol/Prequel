<?php

declare(strict_types = 1);

namespace Protoqol\Prequel\Classes\Database;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

/**
 * Class DatabaseTraverser
 *
 * @package Protoqol\Prequel\Classes\Database
 */
class DatabaseTraverser
{

    /**
     * Type of database e.g. mysql, postgres, sqlite or sql server
     *
     * @var string $databaseConn
     */
    private $databaseConn;

    /**
     * Query collection based on $DB_CONN
     *
     * @var $databaseQueries
     */
    private $databaseQueries;

    /**
     * DatabaseTraverser constructor.
     *
     * @param  string|null  $databaseType  Type of database see $_databaseConn
     */
    public function __construct(?string $databaseType = null)
    {
        $this->databaseConn = $databaseType
            ?: config('database.default');

        $this->databaseQueries = new SequelMorpher($this->databaseConn);
    }

    /**
     * Get all databases and their respective tables
     *
     * @return array
     * @throws \Exception
     */
    public function getAll() :array
    {
        $collection = [];

        foreach ($this->getAllDatabases() as $value) {
            $db_name                      = (object) $value['name'];
            $collection[$db_name->pretty] = [
                "official_name" => $db_name->official,
                "pretty_name"   => $db_name->pretty,
                "tables"        => $this->getTablesFromDB($db_name->official),
            ];
        }

        ksort($collection);

        return $collection;
    }

    /**
     * Get information for column
     *
     * @param  string  $database  Database name
     * @param  string  $table  Table name
     * @param  array  $column  Column name
     *
     * @return array
     */
    public function getColumnData(
        string $database,
        string $table,
        array $column
    ) :array {
        $select = [
            'TABLE_SCHEMA',
            'TABLE_NAME',
            'COLUMN_NAME',
            'COLUMN_DEFAULT',
            'IS_NULLABLE',
            'COLUMN_COMMENT',
        ];

        $result = (DB::table("information_schema.COLUMNS")
            ->select($select)
            ->where([
                ['TABLE_SCHEMA', '=', $database],
                ['TABLE_NAME', '=', $table],
                ['COLUMN_NAME', '=', $column],
            ])
            ->get())->toArray();

        // dd($result);

        return Arr::flatten((array) $result);
    }

    /**
     * Get table structure
     *
     * @param  string  $database  Database name
     * @param  string  $table  Table name
     *
     * @return array
     */
    public function getTableStructure(string $database, string $table) :array
    {
        $columns = DB::select("SHOW COLUMNS FROM `$database`.`$table`");
        // dd($this->getColumnData($database, $table, (array)$columns[1]));
        return $columns;
    }

    /**
     * Get all tables from database
     *
     * @param  string  $database  Database name
     *
     * @return array
     * @throws \Exception
     */
    public function getTablesFromDB(string $database) :array
    {
        $tables = DB::select($this->databaseQueries->showTablesFrom($database));
        return $this->normalise($tables);
    }

    /**
     * Get all tables from "main" database (DB_DATABASE in .env)
     *
     * @return array
     * @throws \Exception
     */
    public function getAllTables() :array
    {
        $tables = DB::select($this->databaseQueries->showTables());
        return $this->normalise($tables);
    }

    /**
     * Get all databases
     *
     * @return array
     * @throws \Exception
     */
    public function getAllDatabases() :array
    {
        $databases = DB::select($this->databaseQueries->showDatabases());
        return $this->normalise($databases);
    }

    /**
     * Normalise query results; assumes a lot about the structure, which can
     * potentially cause problems later on. Assumed structure
     *  -----------------
     *  Array [
     *    Object {
     *       'String': Mixed (single value)
     *  -----------------
     *
     * @param  array  $arr  | Query results
     *
     * @return array
     */
    public function normalise(array $arr)
    {
        $normalised = [];

        for ($iterator = 0; $iterator < count($arr); $iterator++) {
            foreach ($arr[$iterator] as $value) {
                $array_value = ((array) $value)[0];

                $normalised[$iterator]['name'] = [
                    "official" => $array_value,
                    "pretty"   => $this->prettifyName($array_value),
                ];
            }
        }

        return $normalised;
    }

    /**
     * Prettify names, meaning: remove special characters; capitalise each word.
     *
     * @param  string  $name
     *
     * @return string
     */
    public function prettifyName(string $name) :string
    {
        $words       = preg_split('/[!@#$%^&*(),.?":{}|<>_-]/', $name);
        $pretty_name = '';

        for ($iterator = 0; $iterator < count($words); $iterator++) {
            $pretty_name .= ucfirst(strtolower($words[$iterator]));

            if ($iterator !== (count($words) - 1)) {
                $pretty_name .= ' ';
                continue;
            }
        }

        return $pretty_name;
    }
}
