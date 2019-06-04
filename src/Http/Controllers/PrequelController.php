<?php

    namespace Protoqol\Prequel\Http\Controllers;

    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\DB;
    use Protoqol\Prequel\Classes\Database\DatabaseTraverser;

    class PrequelController extends Controller {

        public function index() {
            return view('Prequel::main', [
                'env'                 => [
                    'database' => env('DB_DATABASE'),
                    'host'     => env('DB_HOST'),
                    'port'     => env('DB_PORT'),
                    'user'     => env('DB_USERNAME'),
                ],
                'isConnected'         => (bool)DB::connection()->getDatabaseName(),
                'initialDatabaseData' => app(DatabaseTraverser::class)->getAll(),
            ]);
        }
    }
