<?php
    
    namespace Protoqol\Prequel\Http\Controllers;
    
    use Carbon\Carbon;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller;
    use Protoqol\Prequel\Classes\App\AppStatus;
    use Protoqol\Prequel\Classes\App\Migrations;
    use Protoqol\Prequel\Facades\PDB;
    use Protoqol\Prequel\Classes\Database\DatabaseAction;
    
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
        
        public function import()
        {
            //
        }
        
        public function export()
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
        
        public function generateFactory(string $database, string $table)
        {
        
        }
    }
