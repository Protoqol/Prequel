<?php

    namespace Protoqol\Prequel\Http\Controllers;

    use Exception;
    use Carbon\Carbon;
    use Illuminate\Http\Request;
    use Protoqol\Prequel\App\ModelAction;
    use Protoqol\Prequel\App\SeederAction;
    use Protoqol\Prequel\App\FactoryAction;
    use Illuminate\Routing\Controller;
    use Illuminate\Support\Facades\Artisan;
    use Protoqol\Prequel\App\AppStatus;
    use Protoqol\Prequel\App\MigrationAction;
    use Protoqol\Prequel\Facades\PDB;
    use Protoqol\Prequel\App\ResourceAction;
    use Protoqol\Prequel\Traits\classResolver;
    use Protoqol\Prequel\App\ControllerAction;
    use Protoqol\Prequel\Database\DatabaseAction;
    use phpDocumentor\Reflection\DocBlock\Tags\See;
    use Protoqol\Prequel\Database\DatabaseTraverser;

    /**
     * Class DatabaseActionController
     * @package Protoqol\Prequel\Http\Controllers
     */
    class DatabaseActionController extends Controller
    {

        /**
         * Get defaults for 'Insert new row' action form inputs.
         *
         * @param string $database
         * @param string $table
         *
         * @return array
         */
        public function getDefaultsForTable(string $database, string $table): array
        {
            return [
                'id'           => ((int)PDB::create($database, $table)->builder()->count() + 1),
                'current_date' => Carbon::now()->format('Y-m-d\TH:i'),
            ];
        }

        /**
         * Check and return all Laravel specific assets for table (Model, Seeder, Controller etc.).
         *
         * @param string $database
         * @param string $table
         *
         * @return array
         * @throws \Exception
         */
        public function getInfoAboutTable(string $database, string $table): array
        {
            return [
                'controller' => (new ControllerAction())->getName($database, $table),
                'resource'   => (new ResourceAction())->getName($database, $table),
                'model'      => (new ModelAction())->getName($database, $table),
                'seeder'     => (new SeederAction())->getName($database, $table),
                'factory'    => (new FactoryAction())->getName($database, $table),
            ];
        }

        /**
         * Insert row in table.
         *
         * @param \Illuminate\Http\Request $request
         *
         * @return array
         */
        public function insertNewRow(Request $request): array
        {
            return [
                'success' => (string)(new DatabaseAction($request->database, $request->table))
                    ->insertNewRow($request->post('data')),
            ];
        }

        /**
         * Run raw SQL query.
         *
         * @param Request $request
         * @param string $database
         * @param string $table
         *
         * @return string
         */
        public function runSql(Request $request, string $database, string $table): string
        {

            $queries = explode(';', $request->get('query'));

            return (string)PDB::create($database, $table)->statement($queries);
        }

        /**
         * @param string $database
         * @param string $table
         */
        public function import(string $database, string $table)
        {
            //
        }

        /**
         * @param string $database
         * @param string $table
         */
        public function export(string $database, string $table)
        {
            //
        }

        /**
         * Get database status.
         * @return array
         */
        public function status()
        {
            return (new AppStatus())->getStatus();
        }

        /**
         * Run pending migrations.
         * @return int
         */
        public function runMigrations()
        {
            return (new MigrationAction())->run();
        }

        /**
         * Reset latest migrations.
         * @return int
         */
        public function resetMigrations()
        {
            return (new MigrationAction())->reset();
        }

        /**
         * Generate controller.
         *
         * @param string $database
         * @param string $table
         *
         * @return mixed
         * @throws \Exception
         */
        public function generateController(string $database, string $table)
        {
            return (new ControllerAction())->generate($database, $table);
        }

        /**
         * Generate factory.
         *
         * @param string $database
         * @param string $table
         *
         * @return int|string
         */
        public function generateFactory(string $database, string $table)
        {
            return (new FactoryAction())->generate($database, $table);
        }

        /**
         * Generate model.
         *
         * @param string $database
         * @param string $table
         *
         * @return int
         */
        public function generateModel(string $database, string $table)
        {
            return (new ModelAction())->generate($database, $table);
        }

        /**
         * Generate resource.
         *
         * @param string $database
         * @param string $table
         *
         * @return mixed
         */
        public function generateResource(string $database, string $table)
        {
            return (new ResourceAction())->generate($database, $table);
        }

        /**
         * Generate seeder.
         *
         * @param string $database
         * @param string $table
         *
         * @return int|string
         * @throws \Exception
         */
        public function generateSeeder(string $database, string $table)
        {
            return (new SeederAction())->generate($database, $table);
        }

        /**
         * Run seeder.
         *
         * @param string $database
         * @param string $table
         *
         * @return int
         * @throws \Exception
         */
        public function runSeeder(string $database, string $table)
        {
            return (new SeederAction())->run($database, $table);
        }
    }
