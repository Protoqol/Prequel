<?php


    namespace Protoqol\Prequel\Classes\Database;

    use Illuminate\Support\Arr;
    use Illuminate\Support\Facades\DB;

    class DatabaseTraverser {

        /**
         * Type of database e.g. mysql, postgres, sqlite or sql server
         *
         * @var $DB_CONN
         */
        private $DB_CONN;

        /**
         * Query collection based on $DB_CONN
         *
         * @var $DB_QUERIES
         */
        private $DB_QUERIES;

        /**
         * DatabaseTraverser constructor.
         *
         * @param string|null $databaseType
         */
        public function __construct(?string $databaseType = NULL) {
            $this->DB_CONN    = $databaseType ?: config('database.default');
            $this->DB_QUERIES = new SequelMorpher($this->DB_CONN);
        }

        /**
         * Get all databases and their respective tables
         *
         * @return array
         * @throws \Exception
         */
        public function getAll() :array {
            $databases = $this->getAllDatabases();
            $response  = [];

            foreach ($databases as $value) {
                $response[$value] = $this->getAllTablesFromDatabase($value);
            }

            return $response;
        }

        /**
         * Get all tables from database $databaseName
         *
         * @TODO Escape input, it's very hard to inject anything here. But you can never be too sure.
         *
         * @param string $databaseName
         *
         * @return array
         * @throws \Exception
         */
        public function getAllTablesFromDatabase(string $databaseName) :array {
            $tables = DB::select($this->DB_QUERIES->showTablesFrom($databaseName));

            return $this->normaliser($tables);
        }

        /**
         * Get all tables from "main" database (DB_DATABASE in .env)
         *
         * @return array
         * @throws \Exception
         */
        public function getAllTables() :array {
            $tables = DB::select($this->DB_QUERIES->showTables());

            return $this->normaliser($tables);
        }

        /**
         * Get all databases
         *
         * @return array
         * @throws \Exception
         */
        public function getAllDatabases() :array {
            $databases = DB::select($this->DB_QUERIES->showDatabases());

            return $this->normaliser($databases);
        }

        /**
         * Normalise query results
         *
         * @param array $arr
         *
         * @return array
         */
        public function normaliser(array $arr) {
            $normalised = [];

            for ($i = 0; $i < count($arr); $i++) {
                foreach ($arr[$i] as $key => $value) {
                    $normalised[$i]['name'] = ((array)$value)[0];
                }
            }

            return Arr::flatten($normalised);
        }

    }
