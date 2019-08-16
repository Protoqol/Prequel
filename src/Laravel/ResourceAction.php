<?php
    
    
    namespace Protoqol\Prequel\App;
    
    
    use Exception;
    use Illuminate\Support\Facades\Artisan;
    use Protoqol\Prequel\Traits\resolveClass;
    use Protoqol\Prequel\Interfaces\GenerationInterface;
    
    class ResourceAction implements GenerationInterface
    {
        
        use resolveClass;
    
        /**
         * Generate resource
         *
         * @param string $database
         * @param string $table
         *
         * @return mixed
         * @throws \Exception
         */
        public function generate(string $database, string $table)
        {
            Artisan::call('make:resource', [
                'name' => $this->generateResourceName($table),
            ]);
    
            return $this->getName($database, $table);
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
                return $this->checkAndGetResourceName($table);
            } catch (Exception $e) {
                return $e;
            }
        }
        
        /**
         * Resolve and check resource for table.
         *
         * @param string $table
         *
         * @return string
         * @throws \Exception
         */
        private function checkAndGetResourceName(string $table)
        {
            $resourceClass = 'App\\Http\\Resources\\' . $this->generateResourceName($table);
            
            if (!$this->classExists($resourceClass)) {
                throw new Exception($resourceClass . ' could not be found or your resource does not follow naming convention');
            }
            
            return $resourceClass;
        }
    }
