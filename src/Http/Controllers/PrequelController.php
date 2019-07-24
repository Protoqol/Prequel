<?php

declare(strict_types = 1);

namespace Protoqol\Prequel\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Lang;
use Protoqol\Prequel\Classes\Database\DatabaseTraverser;

/**
 * Class PrequelController
 * @package Protoqol\Prequel\Http\Controllers
 */
class PrequelController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $databaseData = (object)app(DatabaseTraverser::class)->getAll();

        return view('Prequel::main', [
            'env'  => [
                'connection' => config('prequel.database.connection'),
                'database'   => config('prequel.database.database'),
                'host'       => config('prequel.database.host'),
                'port'       => config('prequel.database.port'),
                'user'       => config('prequel.database.username'),
            ],
            'data' => [
                'collection'          => $databaseData->collection,
                'flatTableCollection' => $databaseData->flatTableCollection,
            ],
            'lang' => Lang::get('Prequel::lang', [], (string)config('prequel.locale')),
        ]);
    }
}
