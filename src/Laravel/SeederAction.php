<?php
    
    namespace Protoqol\Prequel\App;
    
    use Exception;
    use Illuminate\Support\Facades\Artisan;
    use Protoqol\Prequel\Traits\classResolver;
    use Protoqol\Prequel\Interfaces\GenerationInterface;
    
    class SeederAction implements GenerationInterface
    {
        
        use classResolver;
        
        /**
         * Generate seeder.
         *
         * @param string $database
         * @param string $table
         *
         * @return int|string
         * @throws \Exception
         */
        public function generate(string $database, string $table)
        {
            Artisan::call('make:seeder', [
                'name' => $this->generateClassName($table) . 'Seeder',
            ]);
    
            $this->dumpAutoload();
            
            return (string)$this->getName($database, $table);
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
        public function run(string $database, string $table)
        {
            return Artisan::call('db:seed', [
                '--class'    => $this->checkAndGetSeederName($table),
                '--database' => $database,
            ]);
        }
        
        /**
         * Get class name, when possible with namespace
         *
         * @param string $database
         * @param string $table
         *
         * @return mixed|string
         * @throws \Exception
         */
        public function getName(string $database, string $table)
        {
            try {
                return $this->checkAndGetSeederName($table);
            } catch (Exception $e) {
                return false;
            }
        }
        
        /**
         * Resolve and check seeder for table.
         *
         * @param string $table
         *
         * @return string
         * @throws \Exception
         */
        private function checkAndGetSeederName(string $table)
        {
            $seederClass = $this->generateSeederName($table);
            
            if (!$this->classExists($seederClass)) {
                throw new Exception($seederClass . ' could not be found or your seeder does not follow naming convention');
            }
            
            return $seederClass;
        }
    }
