<?php


    namespace Protoqol\Prequel\Classes\Database;


    use Exception;

    /**
     * Get queries based on chosen SQL driver.
     *
     * Class SequelMorpher
     * @package Protoqol\LaravelSequel\Classes\Database
     */
    class SequelMorpher {

        private $databaseType;

        public function __construct(string $DB_CONN) {
            $this->databaseType = $DB_CONN;
        }

        public function showTables() {
            switch ($this->databaseType) {
                case 'mysql':
                    return 'SHOW TABLES;';
                case 'pgsql':
                    return 'SELECT * FROM pg_catalog.pg_tables;';
                case 'sqlite':
                    return 'SELECT name FROM sqlite_master WHERE type="table";';
                case 'sqlsrv':
                    return 'SELECT * FROM  INFORMATION_SCHEMA.TABLES; GO';
                default:
                    throw new Exception('Selected invalid or unsupported database driver');
            }
        }

        public function showDatabases() {
            switch ($this->databaseType) {
                case 'mysql':
                    return 'SHOW DATABASES;';
                case 'pgsql':
                    return 'SELECT datname FROM pg_database WHERE datistemplate = false;';
                default:
                    throw new Exception('Selected invalid or unsupported database driver');
            }
        }

        public function showTablesFrom(string $databaseName) {
            switch ($this->databaseType) {
                case 'mysql':
                    return 'SHOW TABLES FROM `'. $databaseName .'`;';
                case 'pgsql':
                    return 'SELECT * FROM pg_catalog.pg_tables;';
                default:
                    throw new Exception('Selected invalid or unsupported database driver');
            }
        }
    }
