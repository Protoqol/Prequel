<?php

namespace Protoqol\Prequel\Http\Controllers;

use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use Protoqol\Prequel\App\AppStatus;
use Protoqol\Prequel\Connection\DatabaseConnector;
use Protoqol\Prequel\Database\DatabaseTraverser;
use Protoqol\Prequel\Facades\PDB;
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
    private $qualifiedName;

    /**
     * Table name
     *
     * @var string $tableName
     */
    private $tableName;

    /**
     * Database name
     *
     * @var string $databaseName
     */
    private $databaseName;

    /**
     * Holds model for given table if one exists.
     *
     * @var Model $model
     */
    private $model;

    /**
     * Holds connection using credentials from config.
     *
     * @var Connection $connection
     */
    private $connection;

    /**
     * DatabaseActionController's constructor
     *
     * @param  Request|PrequelDatabaseRequest  $request
     */
    public function __construct($request)
    {
        $this->tableName     = $request->table;
        $this->databaseName  = $request->database;
        $this->qualifiedName = $request->qualifiedName;
        $this->model         = $request->model;
        $this->connection    = (new DatabaseConnector())->getConnection();
    }

    /**
     * Get table data, table structure and its qualified name
     *
     * @return mixed
     */
    public function getTableData()
    {
        // If Model exists
        if ($this->model && $this->databaseName === config("database.connections.mysql.database")) {
            $paginated = $this->model->paginate(config("prequel.pagination"));
            $paginated->setCollection(
                $paginated
                    ->getCollection()
                    ->each->setHidden([])
                    ->each->setVisible([])
            );

            return [
                "table"     => $this->qualifiedName,
                "data"      => $paginated,
                "structure" => app(DatabaseTraverser::class)->getTableStructure(
                    $this->databaseName,
                    $this->tableName
                ),
            ];
        }

        $data = PDB::create($this->databaseName, $this->tableName)
                   ->builder()
                   ->paginate(config("prequel.pagination"));

        return [
            "table"     => $this->tableName,
            "structure" => app(DatabaseTraverser::class)->getTableStructure(
                $this->databaseName,
                $this->tableName
            ),
            "data"      => json_decode(json_encode($data->toArray(), JSON_INVALID_UTF8_IGNORE), true),
        ];

        //
        //        if (config('database.connections.mysql.prefix')) {
        //                config(['database.connections.mysql.prefix' => '']);
        //                \Illuminate\Support\Facades\DB::purge();
        //         }
        //
        //        // Usage of the DB facade should be avoided since this uses the default config, and not the prequel config. @TODO refactor
        //        return [
        //             "table"     => $this->qualifiedName,
        //             "structure" => app(DatabaseTraverser::class)->getTableStructure(
        //                 $this->databaseName,
        //                 $this->tableName
        //              ),
        //             "data"      => DB::table($this->qualifiedName)->paginate(config('prequel.pagination')),
        //        ];
        //
    }

    /**
     * Find given value in given column with given operator.
     *
     * @return mixed
     */
    public function findInTable()
    {
        $column    = (string) Route::current()->parameter("column");
        $queryType = (string) Route::current()->parameter("type");
        $value     = (string) Route::current()->parameter("value");
        $value     = $queryType === "LIKE" ? "%" . $value . "%" : $value;

        return PDB::create($this->databaseName, $this->tableName)
                  ->builder()
                  ->where($column, $queryType, $value)
                  ->paginate(config("prequel.pagination"));
    }

    /**
     * Get database status.
     *
     * @return array
     */
    public function status(): array
    {
        return (new AppStatus())->getStatus();
    }

    /**
     * Count number of records in the given table
     *
     * @return array
     */
    public function count(): array
    {
        return [
            "count" => $this->model
                ? $this->model->count()
                : PDB::create($this->databaseName, $this->tableName)
                     ->builder()
                     ->count(),
        ];
    }

    /**
     * Export table.
     *
     * @param  Request  $request
     * @param  string  $database
     * @param  string  $table
     *
     * @return JsonResponse
     */
    public function export(Request $request, string $database, string $table): JsonResponse
    {
        $structure = $request->input("structure_only", true) ? "--no-data" : "";

        $host   = config('prequel.database.host');
        $user   = config('prequel.database.username');
        $pass   = config('prequel.database.password');
        $output = [];
        $code   = null;

        $fileName = "{$database}.sql";
        $dir      = storage_path("prequel");

        if (!is_dir($dir)) {
            mkdir($dir);
        }

        $dir .= "/$fileName";

        exec(
            "mysqldump {$structure} --user={$user} --password={$pass} --host={$host} {$database} {$table} --result-file={$dir}",
            $output,
            $code
        );

        return response()->json([
            'status'   => $code,
            'location' => $dir,
        ]);
    }

    /**
     * @return void
     */
    public function import(Request $request, string $database, string $table)
    {
        $database = $request->input('database');
        $table    = $request->input('table');
        $file     = $request->file('import_file');
        //
    }
}
