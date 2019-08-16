<?php
    
    
    namespace Protoqol\Prequel\App;
    
    
    use Illuminate\Support\Facades\Artisan;
    use Protoqol\Prequel\Traits\resolveClass;
    use Protoqol\Prequel\Database\DatabaseTraverser;
    use Protoqol\Prequel\Interfaces\GenerationInterface;
    
    class ModelAction implements GenerationInterface
    {
        
        use resolveClass;
        
        /**
         * Generate
         *
         * @param string $database
         * @param string $table
         *
         * @return mixed
         */
        public function generate(string $database, string $table)
        {
            Artisan::call('make:model', [
                'name' => $this->generateClassName($table),
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
         */
        public function getName(string $database, string $table)
        {
            return (new DatabaseTraverser())->getModel($table)['namespace'];
        }
    }
