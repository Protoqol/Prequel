<?php
    
    namespace Protoqol\Prequel\App;
    
    use Exception;
    use Illuminate\Support\Facades\Artisan;
    use Protoqol\Prequel\Traits\classResolver;
    use Protoqol\Prequel\Interfaces\GenerationInterface;
    
    class FactoryAction implements GenerationInterface
    {
        
        use classResolver;
        
        /**
         * Generate factory.
         *
         * @param string $database
         * @param string $table
         *
         * @return int|string
         * @throws \Exception
         */
        public function generate(string $database, string $table)
        {
            Artisan::call('make:factory', [
                'name' => $this->generateFactoryName($table),
            ]);
            
            $this->dumpAutoload();
            
            return (string)$this->getName($database, $table);
        }
        
        /**
         * Get class name, when possible with namespace
         *
         * @param string $database
         * @param string $table
         *
         * @return mixed
         * @throws \Exception
         */
        public function getName(string $database, string $table)
        {
            try {
                return $this->checkAndGetFactoryName($table);
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
        public function checkAndGetFactoryName(string $table)
        {
            $factoryFile = $this->generateFactoryName($table);
            
            if (!file_exists(base_path('database/factories/' . $factoryFile . '.php'))) {
                throw new Exception($factoryFile . ' could not be found or your factory does not follow naming convention');
            }
            
            return $factoryFile;
        }
    }
