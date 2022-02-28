<?php

namespace Protoqol\Prequel\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Lang;
use Protoqol\Prequel\Database\DatabaseTraverser;

/**
 * Class PrequelController
 *
 * @package Protoqol\Prequel\Http\Controllers
 */
class PrequelController extends Controller
{
    /**
     * Get first entry data
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $databaseData = (object)app(DatabaseTraverser::class)->getAll();

        return view("Prequel::main", [
            "env"    => [
                "connection" => config("prequel.database.connection"),
                "database"   => config("prequel.database.database"),
                "host"       => config("prequel.database.host"),
                "port"       => config("prequel.database.port"),
                "user"       => config("prequel.database.username"),
                'baseUrl'    => config("prequel.baseUrl"),
            ],
            "data"   => [
                "collection"          => $databaseData->collection,
                "flatTableCollection" => $databaseData->flatTableCollection,
            ],
            "lang"   => Lang::get(
                "Prequel::lang",
                [],
                (string)config("prequel.locale")
            ),
        ]);
    }

    /**
     * Auto update Prequel.
     *
     * @param Request $request
     *
     * @return array
     */
    public function autoUpdate(Request $request): array
    {
        $newestVersion = $request->post("newest_version");

        $script = [
            "cd " . base_path(),
            "composer require protoqol/prequel:{$newestVersion} 2>&1",
            "php artisan prequel:update 2>&1",
        ];

        $prepared = implode(" && ", $script);
        exec($prepared, $out, $return);

        return [
            "log"    => $out,
            "return" => $return,
            "script" => $prepared,
        ];
    }
}
