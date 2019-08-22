<?php
    
    
    namespace Protoqol\Prequel\Interfaces;
    
    interface GenerationInterface
    {
        
        /**
         * Generate $generator
         *
         * @param string $database
         * @param string $table
         *
         * @return mixed
         */
        public function generate(string $database, string $table);
        
        /**
         * Get class name, when possible with namespace
         *
         * @param string $database
         * @param string $table
         *
         * @return mixed
         */
        public function getName(string $database, string $table);
    }
