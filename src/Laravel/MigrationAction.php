<?php
    
    
    namespace Protoqol\Prequel\App;
    
    use FilesystemIterator;
    use Illuminate\Support\Facades\Artisan;
    use Protoqol\Prequel\Connection\DatabaseConnector;
    use Protoqol\Prequel\Interfaces\GenerationInterface;
    
    /**
     * Class MigrationAction
     * @package Protoqol\Prequel\App
     */
    class MigrationAction implements GenerationInterface
    {
        
        private $connection;
        
        /**
         * MigrationAction constructor.
         */
        public function __construct()
        {
            $this->connection = (new DatabaseConnector())->getConnection();
        }
        
        /**
         * @return int
         */
        public function run()
        {
            return Artisan::call('migrate');
        }
        
        /**
         * @return int
         */
        public function reset()
        {
            return Artisan::call('migrate:reset');
        }
        
        /**
         * Get total and pending migrations.
         * @return array
         */
        public function pending(): array
        {
            $migrationFileCount = (int)iterator_count(new FilesystemIterator(
                database_path('migrations'),
                FilesystemIterator::SKIP_DOTS
            ));
            
            $migrationTableCount = count($this->connection->select('SELECT id FROM migrations;'));
            
            $pending = $migrationFileCount - $migrationTableCount;
            
            return [
                'pending' => $pending <= 0 ? 0 : $pending,
                'total'   => $migrationFileCount,
            ];
        }
        
        /**
         * Generate $generator
         *
         * @param string $database
         * @param string $table
         *
         * @return mixed
         */
        public function generate(string $database, string $table)
        {
            // TODO: Implement generate() method.
        }
        
        /**
         * Get class name, when possible with namespace
         *
         * @param string $database
         * @param string $table
         *
         * @return mixed
         */
        public function getName(string $database, string $table)
        {
            // TODO: Implement getName() method.
        }
    }
