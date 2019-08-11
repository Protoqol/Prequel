<?php
    
    namespace Protoqol\Prequel\Http\Controllers;
    
    use Exception;
    use Carbon\Carbon;
    use Illuminate\Support\Str;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller;
    use Illuminate\Support\Facades\Artisan;
    use Protoqol\Prequel\App\AppStatus;
    use Protoqol\Prequel\App\Migrations;
    use Protoqol\Prequel\Facades\PDB;
    use Protoqol\Prequel\Database\DatabaseAction;
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
         * Get some basic information about the table regarding management functionality.
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
                $seeder = $this->checkAndGetSeederName($table);
            } catch (Exception $e) {
                $seeder = false;
            }
            
            return [
                'model'   => (new DatabaseTraverser())->getModel($table)['namespace'] ?? false,
                'seeder'  => $seeder,
                'factory' => true,
            ];
        }
        
        /**
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
         * Generate factory.
         *
         * @param string $database
         * @param string $table
         */
        public function generateFactory(string $database, string $table)
        {
            // Artisan create factory
        }
        
        /**
         * Generate seeder.
         *
         * @param string $database
         * @param string $table
         *
         * @return int
         */
        public function generateSeeder(string $database, string $table)
        {
            return Artisan::call('make:seeder', [
                'name' => $this->generateClassName($table) . 'Seeder',
            ]);
        }
        
        /**
         * Run specified seeder.
         *
         * @param string $database
         * @param string $table
         *
         * @return int
         * @throws \Exception
         */
        public function runSeeder(string $database, string $table)
        {
            return Artisan::call('db:seed', [
                '--class'    => $this->checkAndGetSeederName($table),
                '--database' => $database,
            ]);
        }
        
        /**
         * Resolve and check seeder for table.
         *
         * @param string $table
         *
         * @return string
         * @throws \Exception
         */
        public function checkAndGetSeederName(string $table)
        {
            $seederClass = $this->generateClassName($table) . 'Seeder';
            
            if (!class_exists($seederClass)) {
                throw new Exception($seederClass . ' could not be found or your seeder does not follow naming convention');
            }
            
            return $seederClass;
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
            return Artisan::call('make:model', [
                'name' => $this->generateClassName($table),
            ]);
        }
        
        /**
         * Generate SingularStudlyClassName.
         *
         * @param string $classname
         *
         * @return string
         */
        public function generateClassName(string $classname)
        {
            return Str::studly(Str::singular($classname));
        }
    }
