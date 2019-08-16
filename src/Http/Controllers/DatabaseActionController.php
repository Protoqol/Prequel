<?php
    
    namespace Protoqol\Prequel\Http\Controllers;
    
    use Exception;
    use Carbon\Carbon;
    use Illuminate\Http\Request;
    use Protoqol\Prequel\App\ModelAction;
    use Protoqol\Prequel\App\SeederAction;
    use Protoqol\Prequel\App\FactoryAction;
    use Illuminate\Routing\Controller;
    use Illuminate\Support\Facades\Artisan;
    use Protoqol\Prequel\App\AppStatus;
    use Protoqol\Prequel\App\Migrations;
    use Protoqol\Prequel\Facades\PDB;
    use Protoqol\Prequel\App\ResourceAction;
    use Protoqol\Prequel\Traits\resolveClass;
    use Protoqol\Prequel\App\ControllerAction;
    use Protoqol\Prequel\Database\DatabaseAction;
    use phpDocumentor\Reflection\DocBlock\Tags\See;
    use Protoqol\Prequel\Database\DatabaseTraverser;
    
    /**
     * Class DatabaseActionController
     * @package Protoqol\Prequel\Http\Controllers
     */
    class DatabaseActionController extends Controller
    {
        
        /**
         * Get defaults for 'Insert new row' action form inputs.
         *
         * @param string $database
         * @param string $table
         *
         * @return array
         */
        public function getDefaultsForTable(string $database, string $table): array
        {
            return [
                'id'           => ((int)PDB::create($database, $table)->count() + 1),
                'current_date' => Carbon::now()->format('Y-m-d\TH:i'),
            ];
        }
        
        /**
         * Check and return all Laravel specific assets for table (Model, Seeder, Controller etc.).
         *
         * @param string $database
         * @param string $table
         *
         * @return array
         * @throws \Exception
         */
        public function getInfoAboutTable(string $database, string $table): array
        {
            try {
                $controller = (new ControllerAction())->getName($database, $table);
            } catch (Exception $e) {
                $controller = false;
            }
            
            try {
                $resource = (new ResourceAction())->getName($database, $table);
            } catch (Exception $e) {
                $resource = false;
            }
            
            try {
                $model = (new ModelAction())->getName($database, $table);
            } catch (Exception $e) {
                $model = false;
            }
            
            try {
                $seeder = (new SeederAction())->getName($database, $table);
            } catch (Exception $e) {
                $seeder = false;
            }
            
            try {
                $factory = (new FactoryAction())->getName($database, $table);
            } catch (Exception $e) {
                $factory = false;
            }
            
            return [
                'controller' => $controller,
                'resource'   => $resource,
                'model'      => $model,
                'seeder'     => $seeder,
                'factory'    => $factory,
            ];
        }
        
        /**
         * Insert row in table.
         *
         * @param \Illuminate\Http\Request $request
         *
         * @return array
         */
        public function insertNewRow(Request $request): array
        {
            return [
                'success' => (string)(new DatabaseAction($request->database, $request->table))
                    ->insertNewRow($request->post('data')),
            ];
        }
        
        /**
         * Run raw SQL query.
         *
         * @param string $database
         * @param string $table
         * @param string $query
         *
         * @return string
         */
        public function runSql(string $database, string $table, string $query): string
        {
            return (string)PDB::create($database, $table)->statement($query);
        }
        
        /**
         * @param string $database
         * @param string $table
         */
        public function import(string $database, string $table)
        {
            //
        }
        
        /**
         * @param string $database
         * @param string $table
         */
        public function export(string $database, string $table)
        {
            //
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
         * Run pending migrations.
         * @return int
         */
        public function runMigrations()
        {
            return (new Migrations())->run();
        }
        
        /**
         * Reset latest migrations.
         * @return int
         */
        public function resetMigrations()
        {
            return (new Migrations())->reset();
        }
        
        /**
         * Generate controller.
         *
         * @param string $database
         * @param string $table
         *
         * @return mixed
         */
        public function generateController(string $database, string $table)
        {
            return (new ControllerAction())->generate($database, $table);
        }
        
        /**
         * Generate factory.
         *
         * @param string $database
         * @param string $table
         *
         * @return int|string
         */
        public function generateFactory(string $database, string $table)
        {
            return (new FactoryAction())->generate($database, $table);
        }
        
        /**
         * Generate model.
         *
         * @param string $database
         * @param string $table
         *
         * @return int
         */
        public function generateModel(string $database, string $table)
        {
            return (new ModelAction())->generate($database, $table);
        }
        
        /**
         * Generate resource.
         *
         * @param string $database
         * @param string $table
         *
         * @return mixed
         */
        public function generateResource(string $database, string $table)
        {
            return (new ResourceAction())->generate($database, $table);
        }
        
        /**
         * Generate seeder.
         *
         * @param string $database
         * @param string $table
         *
         * @return int|string
         * @throws \Exception
         */
        public function generateSeeder(string $database, string $table)
        {
            return (new SeederAction())->generate($database, $table);
        }
        
        /**
         * Run seeder.
         *
         * @param string $database
         * @param string $table
         *
         * @return int
         * @throws \Exception
         */
        public function runSeeder(string $database, string $table)
        {
            return (new SeederAction())->run($database, $table);
        }
    }
