<?php

namespace Protoqol\Prequel\Database;

use Illuminate\Support\Facades\DB;

class DatabaseAction
{
    /**
     * @var string
     */
    private $database;

    /**
     * @var string
     */
    private $table;

    /**
     * DatabaseAction constructor.
     *
     * @param string $database
     * @param string $table
     */
    public function __construct(string $database, string $table)
    {
        $this->database = $database;
        $this->table = $table;
    }

    // @TODO MOVE TO PDB::CLASS FACADE
    public function insertNewRow(array $data)
    {
        return DB::table($this->database . "." . $this->table)->insert($data);
    }
}
