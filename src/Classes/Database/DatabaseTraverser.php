<?php


    namespace Protoqol\Prequel\Classes\Database;

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
            $this->DB_CONN = $databaseType
                ?: config('database.default');

            $this->DB_QUERIES = new SequelMorpher($this->DB_CONN);
        }

        /**
         * Get all databases and their respective tables
         *
         * @return array
         * @throws \Exception
         */
        public function getAll() :array {
            $collection = [];

            foreach ($this->getAllDatabases() as $value) {
                $collection[$value['name']['pretty']] = [
                    "official_name" => $value['name']['official'],
                    "columns"       => $this->getAllTablesFromDatabase($value['name']['official']),
                ];
            }

            return $collection;
        }

        /**
         * Get all tables from database $databaseName
         *
         * @param string $databaseName
         *
         * @return array
         * @throws \Exception
         */
        public function getAllTablesFromDatabase(string $databaseName) :array {
            $tables = DB::select($this->DB_QUERIES->showTablesFrom($databaseName));

            return $this->normalise($tables);
        }

        /**
         * Get all tables from "main" database (DB_DATABASE in .env)
         *
         * @return array
         * @throws \Exception
         */
        public function getAllTables() :array {
            $tables = DB::select($this->DB_QUERIES->showTables());

            return $this->normalise($tables);
        }

        /**
         * Get all databases
         *
         * @return array
         * @throws \Exception
         */
        public function getAllDatabases() :array {
            $databases = DB::select($this->DB_QUERIES->showDatabases());

            return $this->normalise($databases);
        }

        /**
         * Normalise query results; assumes a lot about the structure, which can cause problems later on.
         * @TODO Make dumber
         *
         *  Assumed structure
         *  -----------------
         *  Array [
         *    Object {
         *       'String': Mixed (single value)
         *  -----------------
         *
         * @param array $arr
         *
         * @return array
         */
        public function normalise(array $arr) {
            $normalised = [];

            for ($i = 0; $i < count($arr); $i++) {
                foreach ($arr[$i] as $key => $value) {
                    $normalised[$i]['name'] = [
                        "official" => ((array)$value)[0],
                        "pretty"   => $this->prettifyName(((array)$value)[0]),
                    ];
                }
            }

            return $normalised;
        }

        /**
         * Prettify names: remove special characters; capitalise each word.
         *
         * @param string $name
         *
         * @return string
         */
        public function prettifyName(string $name) :string {
            $words      = preg_split('/[!@#$%^&*(),.?":{}|<>_-]/', $name);
            $prettyName = '';

            for ($i = 0; $i < count($words); $i++) {
                $prettyName .= ucfirst($words[$i]);

                if ($i !== (count($words) - 1)) {
                    $prettyName .= ' ';
                    continue;
                }
            }

            return $prettyName;
        }
    }
