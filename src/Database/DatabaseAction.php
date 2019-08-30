<?php

    namespace Protoqol\Prequel\Database;

    use Protoqol\Prequel\Facades\PDB;

    class DatabaseAction
    {

        private $database;

        private $table;

        public function __construct(string $database, string $table)
        {
            $this->database = $database;
            $this->table    = $table;
        }

        public function insertNewRow(array $data)
        {
            return (string)PDB::create($this->database, $this->table)->builder()->insert($data);
        }

    }
