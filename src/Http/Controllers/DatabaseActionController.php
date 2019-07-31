<?php
    
    namespace Protoqol\Prequel\Http\Controllers;
    
    use Carbon\Carbon;
    use Illuminate\Routing\Controller;
    use Protoqol\Prequel\Classes\App\AppStatus;
    use Protoqol\Prequel\Classes\App\Migrations;
    use Protoqol\Prequel\Facades\PDB;
    
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
         * @return mixed
         */
        public function getDefaultsForTable(string $database, string $table)
        {
            return [
                'id'           => ((int)PDB::create($database, $table)->count() + 1),
                'current_date' => Carbon::now()->format('Y-m-d\TH:i:s'),
            ];
        }
        
        /**
         *
         */
        public function runSql()
        {
            //
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
    }
