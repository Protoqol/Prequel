<?php
    
    namespace Protoqol\Prequel\Database;
    
    use Protoqol\Prequel\Facades\PDB;
    use Illuminate\Support\Facades\DB;
    
    class DatabaseAction
    {
        
        private $database;
        
        private $table;
        
        public function __construct(string $database, string $table)
        {
            $this->database = $database;
            $this->table    = $table;
        }
        
        // @TODO MOVE TO PDB::CLASS FACADE
        public function insertNewRow(array $data)
        {
            return DB::table($this->database . '.' . $this->table)->insert($data);
        }
        
    }
