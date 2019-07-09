<?php

declare(strict_types = 1);

namespace Protoqol\Prequel\Http\Controllers;

use Illuminate\Routing\Controller;
use Protoqol\Prequel\Classes\Database\DatabaseConnector;
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
        $databaseData = (object) app(DatabaseTraverser::class)->getAll();

        return view('Prequel::main', [
            'env'  => [
                'connection' => config('prequel.DB.CONNECTION'),
                'database'   => config('prequel.DB.DATABASE'),
                'host'       => config('prequel.DB.HOST'),
                'port'       => config('prequel.DB.PORT'),
                'user'       => config('prequel.DB.USERNAME'),
            ],
            'data' => [
                'collection'          => $databaseData->collection,
                'flatTableCollection' => $databaseData->flatTableCollection,
            ],
        ]);
    }
}
