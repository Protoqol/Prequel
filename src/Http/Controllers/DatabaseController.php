<?php
    
    
    namespace Protoqol\Prequel\Http\Controllers;
    
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Routing\Controller;
    use Illuminate\Support\Facades\Route;
    use Protoqol\Prequel\App\AppStatus;
    use Protoqol\Prequel\App\MigrationAction;
    use Protoqol\Prequel\Connection\DatabaseConnector;
    use Protoqol\Prequel\Database\DatabaseTraverser;
    use Protoqol\Prequel\Facades\PDB;
    
    /**
     * Class DatabaseActionController
     * @package Protoqol\Prequel\Http\Controllers
     */
    class DatabaseController extends Controller
    {
        
        /**
         * Qualified table name; 'database.table'
         * @var string $qualifiedName
         */
        private $qualifiedName;
        
        /**
         * Table name
         * @var string $tableName
         */
        private $tableName;
        
        /**
         * Database name
         * @var string $databaseName
         */
        private $databaseName;
        
        /**
         * Holds model for given table if one exists.
         * @var Model $model
         */
        private $model;
        
        /**
         * Holds connection using credentials from config.
         * @var \Illuminate\Database\Connection $connection
         */
        private $connection;
        
        /**
         * DatabaseActionController's constructor
         *
         * @param \Illuminate\Http\Request|\Protoqol\Prequel\Http\Requests\PrequelDatabaseRequest $request
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
         * @return mixed
         */
        public function getTableData()
        {
            // If Model exists
            if ($this->model && $this->databaseName === config('database.connections.mysql.database')) {
                $paginated = $this->model->paginate(config('prequel.pagination'));
                $paginated->setCollection($paginated->getCollection()->each->setHidden([])->each->setVisible([]));
                
                return [
                    "table"     => $this->qualifiedName,
                    "data"      => $paginated,
                    "structure" => app(DatabaseTraverser::class)->getTableStructure(
                        $this->databaseName,
                        $this->tableName
                    ),
                ];
            }
            
            return [
                "table"     => $this->tableName,
                "structure" => app(DatabaseTraverser::class)->getTableStructure(
                    $this->databaseName,
                    $this->tableName
                ),
                "data"      => PDB::create($this->databaseName, $this->tableName)->paginate(config('prequel.pagination')),
            ];
        }
        
        /**
         * Find given value in given column with given operator.
         * @return mixed
         */
        public function findInTable()
        {
            $column    = (string)Route::current()->parameter('column');
            $queryType = (string)Route::current()->parameter('type');
            $value     = (string)Route::current()->parameter('value');
            $value     = ($queryType === 'LIKE') ? '%' . $value . '%' : $value;
            
            return PDB::create($this->databaseName, $this->tableName)
                      ->where($column, $queryType, $value)
                      ->paginate(config('prequel.pagination'));
        }
        
        /**
         * Get database status.
         * @return array
         */
        public function status()
        {
            return (new AppStatus())->getStatus();
        }
        
        /**
         * Count number of records in the given table
         * @return array
         */
        public function count()
        {
            return [
                'count' => $this->model ? $this->model->count() : PDB::create($this->databaseName, $this->tableName)->count(),
            ];
        }
        
        /**
         * Run pending migrations.
         * @return int
         */
        public function runMigrations()
        {
            return (new MigrationAction())->run();
        }
        
        /**
         * Reset latest migrations.
         * @return int
         */
        public function resetMigrations()
        {
            return (new MigrationAction())->reset();
        }
    }
