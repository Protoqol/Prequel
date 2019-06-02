<?php

    namespace Protoqol\Prequel\Http\Controllers;

    use App\Http\Controllers\Controller;
    use Protoqol\LaravelSequel\Classes\Database\DatabaseTraverser;

    class DatabaseViewController extends Controller {

        public function getTables() {
            return (new DatabaseTraverser())->getAllTables();
        }

        public function getDatabases() {
            return (new DatabaseTraverser())->getAllDatabases();
        }
    }
