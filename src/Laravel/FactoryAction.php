<?php
    
    
    namespace Protoqol\Prequel\App;
    
    
    use Exception;
    use Illuminate\Support\Facades\Artisan;
    use Protoqol\Prequel\Traits\resolveClass;
    use Protoqol\Prequel\Interfaces\GenerationInterface;
    
    class FactoryAction implements GenerationInterface
    {
        
        use resolveClass;
        
        /**
         * Generate factory.
         *
         * @param string $database
         * @param string $table
         *
         * @return int|string
         */
        public function generate(string $database, string $table)
        {
            Artisan::call('make:factory', [
                'name' => $this->generateFactoryName($table),
            ]);
            
            // Assumes a lot about the user's environment.
            exec('composer dump-autoload');
            
            try {
                return $this->checkAndGetFactoryName($table) ?? 0;
            } catch (Exception $e) {
                return 0;
            }
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
                return $e;
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
