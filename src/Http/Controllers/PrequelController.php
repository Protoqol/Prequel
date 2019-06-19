<?php

declare(strict_types = 1);

namespace Protoqol\Prequel\Http\Controllers;

use Illuminate\Routing\Controller;
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
                'connection' => config('database.default'),
                'database'   => config('database.connections.mysql.database'),
                'host'       => config('database.connections.mysql.host'),
                'port'       => config('database.connections.mysql.port'),
                'user'       => config('database.connections.mysql.username'),
            ],
            'initialDatabaseData' => app(DatabaseTraverser::class)->getAll(),
        ]);
    }
}
