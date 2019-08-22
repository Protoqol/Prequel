<?php
    
    namespace Protoqol\Prequel\App;
    
    use Exception;
    use Illuminate\Support\Facades\Artisan;
    use Protoqol\Prequel\Traits\classResolver;
    use Protoqol\Prequel\Interfaces\GenerationInterface;
    
    class ControllerAction implements GenerationInterface
    {
        
        use classResolver;
        
        /**
         * Generate
         *
         * @param string $database
         * @param string $table
         *
         * @return mixed
         * @throws \Exception
         */
        public function generate(string $database, string $table)
        {
            Artisan::call('make:controller', [
                'name' => $this->generateControllerName($table),
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
                return $this->checkAndGetControllerName($table);
            } catch (Exception $e) {
                return false;
            }
        }
        
        /**
         * Resolve and check controller for table.
         *
         * @param string $table
         *
         * @return string
         * @throws \Exception
         */
        private function checkAndGetControllerName(string $table)
        {
            $controllerClass = 'App\\Http\\Controllers\\' . $this->generateControllerName($table);
            
            if (!$this->classExists($controllerClass)) {
                throw new Exception($controllerClass . ' could not be found or your controller does not follow naming convention');
            }
            
            return $controllerClass;
        }
    }
