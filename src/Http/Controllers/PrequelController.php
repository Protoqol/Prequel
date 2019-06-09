<?php

declare(strict_types = 1);

namespace Protoqol\Prequel\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Protoqol\Prequel\Classes\Database\DatabaseTraverser;

/**
 * Class PrequelController
 *
 * @package Protoqol\Prequel\Http\Controllers
 */
class PrequelController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('Prequel::main', [
            'env'                 => [
                'database' => env('DB_DATABASE'),
                'host'     => env('DB_HOST'),
                'port'     => env('DB_PORT'),
                'user'     => env('DB_USERNAME'),
            ],
            'isConnected'         => (bool) DB::connection()->getDatabaseName(),
            'initialDatabaseData' => app(DatabaseTraverser::class)->getAll(),
        ]);
    }
}
