<?php

declare(strict_types = 1);

namespace Protoqol\Prequel\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Protoqol\Prequel\Classes\Database\DatabaseTraverser;
use Protoqol\Prequel\Http\Requests\PrequelDatabaseRequest;

/**
 * Class DatabaseActionController
 *
 * @package Protoqol\Prequel\Http\Controllers
 */
class DatabaseController extends Controller
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
     * Holds model for given table if one exists.
     *
     * @var Model $model
     */
    public $model;

    /**
     * DatabaseActionController's constructor
     *
     * @param  \Protoqol\Prequel\Http\Requests\PrequelDatabaseRequest  $request
     */
    public function __construct(PrequelDatabaseRequest $request)
    {
        $this->tableName     = $request->table;
        $this->databaseName  = $request->database;
        $this->qualifiedName = $request->qualifiedName;
        $this->model         = $request->model;
    }

    /**
     * Get table data, table structure and its qualified name
     *
     * @return mixed
     */
    public function getTableData()
    {
        if ($this->model
            && $this->databaseName
            === config('database.connections.mysql.database')
        ) {
            $tableData = $this->model->paginate(config('prequel.paginate-per-page'));
        } else {
            $tableData = DB::table($this->qualifiedName)->paginate(config('prequel.paginate-per-page'));
        }

//        dd($tableData);
        return [
            "table"     => $this->qualifiedName,
            "structure" => app(DatabaseTraverser::class)->getTableStructure(
                $this->databaseName,
                $this->tableName
            ),
            "data"      => $tableData,
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

    /**
     * Try to find input in each column in table.
     *
     * @TODO Prefetch if possible with ID
     * @TODO Clean up, this is nowhere near production ready
     * @return mixed
     */
    public function findInTable()
    {
        $column    = Route::current()->parameter('column');
        $value     = Route::current()->parameter('value');
        $queryType = Route::current()->parameter('type');

        if ($queryType === 'LIKE') {
            return $this->model
                ? $this->model->where($column, 'LIKE', '%'.$value.'%')
                    ->paginate(config('prequel.paginate-per-page'))
                : DB::table($this->qualifiedName)
                    ->where($column, 'LIKE', '%'.$value.'%')
                    ->paginate(config('prequel.paginate-per-page'));
        }

        return $this->model
            ? $this->model->where($column, $queryType, $value)
                ->paginate(100)
            : DB::table($this->qualifiedName)
                ->where($column, $queryType, $value)->paginate(config('prequel.paginate-per-page'));
    }
}
