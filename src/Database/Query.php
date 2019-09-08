<?php
    
    namespace Protoqol\Prequel\Database;
    
    use Illuminate\Support\Arr;
    use Illuminate\Support\Str;
    use Illuminate\Http\Request;
    use Protoqol\Prequel\Facades\PDB;
    
    /**
     * Class Query
     * @package Protoqol\Prequel\Database
     */
    class Query
    {
        
        /**
         * @var mixed
         */
        private $database;
        
        /**
         * @var mixed
         */
        private $table;
        
        /**
         * @var array
         */
        private $queries;
        
        /**
         * Query constructor.
         *
         * @param \Illuminate\Http\Request $request
         */
        public function __construct(Request $request)
        {
            $this->database = $request->database;
            $this->table    = $request->table;
            $this->queries  = $this->collector($request->all('query'));
        }
        
        /**
         * General purpose query runner with all information packed in response
         * @return array
         */
        public function get()
        {
            $arr = [];
            
            $iteration = 0;
            foreach ($this->queries as $query) {
                $query   = trim($query);
                $results = Arr::collapse($this->run($query));
                $rows    = $this->getRows($results);
                
                $arr[$iteration] = [
                    'query'   => $query,
                    'columns' => $rows,
                    'data'    => $results,
                    'type'    => $this->getType($query),
                ];
                
                $iteration++;
            }
            
            return $arr;
        }
        
        /**
         * Run query
         *
         * @param $query
         *
         * @return mixed
         */
        public function run(string $query)
        {
            $realQuery = [$query];
            
            try {
                return PDB::create($this->database, $this->table)->statement($realQuery);
            } catch (\Exception $exception) {
                return $exception;
            }
        }
        
        /**
         * Collect array with all queries
         *
         * @param array $queryString
         *
         * @return array
         */
        private function collector(array $queryString)
        {
            $queries = explode(';', $queryString['query']);
            
            foreach ($queries as $key => $query) {
                if (!$query || empty($query) || $query === '') {
                    unset($queries[$key]);
                }
            }
            
            return $queries;
        }
        
        /**
         * Get simple query type
         *
         * @param string $query
         *
         * @return bool|string
         */
        private function getType(string $query)
        {
            $str   = strtolower($query);
            $types = (object)[
                'ddl' => ['create', 'alter', 'rename', 'drop', 'truncate'],
                'dml' => ['insert', 'delete', 'update', 'lock', 'merge'],
                'dcl' => ['grant', 'revoke'],
                'dql' => ['select'],
            ];
            
            switch ($str) {
                case Str::contains($str, $types->ddl):
                    return 'ddl';
                case Str::contains($str, $types->dml):
                    return 'dml';
                case Str::contains($str, $types->dcl):
                    return 'dcl';
                case Str::contains($str, $types->dql):
                    return 'dql';
                default:
                    return false;
            }
        }
        
        /**
         * Get key names of results
         *
         * @param $results
         *
         * @return array|bool
         */
        private function getRows($results)
        {
            if (!$results || empty($results)) {
                return false;
            }
            
            $sample = (array)$results[0];
            $keys   = [];
            
            foreach ($sample as $key => $value) {
                $keys[] = [
                    'Key'   => $key,
                    'Field' => $key,
                    'Type'  => $key,
                ];
            }
            
            return $keys;
        }
        
        /**
         * Check if valid SQL @TODO
         *
         * @param string $query
         *
         * @return bool
         */
        private function isValid(string $query)
        {
            return true;
        }
    }
