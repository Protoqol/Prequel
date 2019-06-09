<?php

namespace Protoqol\Prequel\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Protoqol\Prequel\Classes\Database\DatabaseTraverser;

class DatabaseActionController extends Controller
{

    /**
     * Qualified table name; 'database.table'
     *
     * @var string $table
     */
    public $qualified_name;

    /**
     * Table name
     *
     * @var string $table_name
     */
    public $table_name;

    /**
     * Database name
     *
     * @var string $database_name
     */
    public $database_name;

    /**
     * DatabaseActionController's constructor
     */
    public function __construct()
    {
        $this->table_name     = Route::current()->parameter('table');
        $this->database_name  = Route::current()->parameter('database');
        $this->qualified_name = $this->database_name . '.' . $this->table_name;

        if (empty($this->qualified_name) || !isset($this->qualified_name)) {
            response('Could not construct sensible table name', 500);
        }
    }

    /**
     * Get table data, table structure and its qualified name
     *
     * @TODO dynamic paginate count
     *
     * @return array
     */
    public function getTableData(): array
    {
        return [
            "table"     => $this->qualified_name,
            "structure" => app(DatabaseTraverser::class)->getTableStructure($this->database_name, $this->table_name),
            "data"      => DB::table($this->qualified_name)->paginate(100),
        ];
    }

    /**
     * Get count of rows in table
     *
     * @return array
     */
    public function countTableRecords(): array
    {
        $count = DB::table($this->qualified_name)
            ->count('id');

        return [
            "table" => $this->qualified_name,
            "count" => $count,
        ];
    }
}
