<?php

declare(strict_types = 1);

namespace Protoqol\Prequel\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Protoqol\Prequel\Classes\Database\DatabaseTraverser;

/**
 * Class DatabaseActionController
 *
 * @package Protoqol\Prequel\Http\Controllers
 */
class DatabaseActionController extends Controller
{

    /**
     * Qualified table name; 'database.table'
     *
     * @var string $qualifiedName
     */
    public $qualifiedName;

    /**
     * Table name
     *
     * @var string $tableName
     */
    public $tableName;

    /**
     * Database name
     *
     * @var string $databaseName
     */
    public $databaseName;

    /**
     * DatabaseActionController's constructor
     */
    public function __construct()
    {
        if (empty($this->qualifiedName) || !isset($this->qualifiedName)) {
            response('Could not construct sensible table name', 500);
        }

        $this->tableName     = Route::current()->parameter('table');
        $this->databaseName  = Route::current()->parameter('database');
        $this->qualifiedName = $this->databaseName.'.'.$this->tableName;
    }

    /**
     * Get table data, table structure and its qualified name
     *
     * @TODO dynamic paginate count (be able to choose nr. of results in
     *     frontend)
     * @return array
     */
    public function getTableData() :array
    {
        return [
            "table"     => $this->qualifiedName,
            "structure" => app(DatabaseTraverser::class)->getTableStructure(
                $this->databaseName,
                $this->tableName
            ),
            "data"      => DB::table($this->qualifiedName)->paginate(100),
        ];
    }

    /**
     * Get count of rows in table
     *
     * @return array
     */
    public function countTableRecords() :array
    {
        $count = DB::table($this->qualifiedName)
            ->count('id');

        return [
            "table" => $this->qualifiedName,
            "count" => $count,
        ];
    }
}
