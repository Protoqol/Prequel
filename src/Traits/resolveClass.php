<?php
    
    
    namespace Protoqol\Prequel\Traits;
    
    
    use Illuminate\Support\Str;
    
    trait resolveClass
    {
        
        /**
         * Check for class existence
         *
         * @param string $classname
         * @param array  $namespaces
         *
         * @return bool
         */
        public function classExists(string $classname, array $namespaces = null)
        {
            return class_exists($classname);
        }
        
        /**
         * Transform string to SingularStudlyClassName
         *
         * @param string $classname
         *
         * @return string
         */
        public function generateClassName(string $classname)
        {
            return Str::studly(Str::singular($classname));
        }
        
        /**
         * @param $classname
         *
         * @return string
         */
        public function generateControllerName(string $classname)
        {
            return $this->generateClassName($classname) . 'Controller';
        }
        
        /**
         * @param $classname
         *
         * @return string
         */
        public function generateFactoryName(string $classname)
        {
            return $this->generateClassName($classname) . 'Factory';
        }
        
        /**
         * @param $classname
         *
         * @return string
         */
        public function generateModelName(string $classname)
        {
            return $this->generateClassName($classname) . 'Model';
        }
        
        /**
         * @param $classname
         *
         * @return string
         */
        public function generateResourceName(string $classname)
        {
            return $this->generateClassName($classname) . 'Resource';
        }
        
        /**
         * @param $classname
         *
         * @return string
         */
        public function generateSeederName(string $classname)
        {
            return $this->generateClassName($classname) . 'Seeder';
        }
        
    }
