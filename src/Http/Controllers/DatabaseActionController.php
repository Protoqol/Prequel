<?php

declare(strict_types = 1);

namespace Protoqol\Prequel\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Protoqol\Prequel\Classes\Database\DatabaseTraverser;
use Symfony\Component\VarDumper\Cloner\Data;

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
     * Holds model for given table if one exists.
     *
     * @var Model $model
     */
    public $model;

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
        $this->model         = app(DatabaseTraverser::class)
            ->getModel($this->tableName);
    }

    /**
     * Get table data, table structure and its qualified name
     *
     * @return mixed
     */
    public function getTableData()
    {
        $tableData = $this->model
            ? $this->model->paginate(100)
            : DB::table($this->qualifiedName)->paginate(100);


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
        return response('Unfinished feature', 501);

//        $whereRawQuery
//            = "SELECT * FROM `$this->databaseName`.`$this->tableName` WHERE ";
//
//        $tableStructure = app(DatabaseTraverser::class)
//            ->getTableStructure($this->databaseName, $this->tableName);
//
//        $length   = count($tableStructure);
//        $currentI = 0;
//
//        foreach ($tableStructure as $struct) {
//            $currentI++;
//            $whereQuery[] = [$struct->Field, '=', 1];
//
//            if ($currentI === 1) {
//                $whereRawQuery .= '(';
//            }
//
//            $whereRawQuery .= "`$struct->Field` LIKE '%$this->query%'";
//
//            if ($length !== $currentI) {
//                $whereRawQuery .= ' OR ';
//            } else {
//                $whereRawQuery .= ');';
//            }
//        }
//
//
//        return DB::select(DB::raw((string) $whereRawQuery));
    }
}
