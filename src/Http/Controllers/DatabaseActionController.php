<?php

namespace Protoqol\Prequel\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Protoqol\Prequel\App\AppStatus;
use Protoqol\Prequel\App\ControllerAction;
use Protoqol\Prequel\App\FactoryAction;
use Protoqol\Prequel\App\MigrationAction;
use Protoqol\Prequel\App\ModelAction;
use Protoqol\Prequel\App\ResourceAction;
use Protoqol\Prequel\App\SeederAction;
use Protoqol\Prequel\Database\DatabaseAction;
use Protoqol\Prequel\Database\Query;
use Protoqol\Prequel\Facades\PDB;

/**
 * Class DatabaseActionController
 *
 * @package Protoqol\Prequel\Http\Controllers
 */
class DatabaseActionController extends Controller
{
    /**
     * Get defaults for 'Insert new row' action form inputs.
     *
     * @param Request $request
     *
     * @return array
     */
    public function getDefaultsForTable(Request $request): array
    {
        return [
            "id"           =>
                (int)PDB::create($request->database, $request->table)
                    ->builder()
                    ->count() + 1,
            "current_date" => Carbon::now()->format("Y-m-d\TH:i"),
        ];
    }

    /**
     * Check and return all Laravel specific assets for table (Model, Seeder, Controller etc.).
     *
     * @param string $database
     * @param string $table
     *
     * @return array
     * @throws Exception
     */
    public function getInfoAboutTable(string $database, string $table): array
    {
        return [
            "controller" =>
                (new ControllerAction($database, $table))->getQualifiedName() ??
                false,
            "resource"   => (new ResourceAction(
                $database,
                $table
            ))->getQualifiedName(),
            "model"      => (new ModelAction($database, $table))->getQualifiedName(),
            "seeder"     => (new SeederAction(
                $database,
                $table
            ))->getQualifiedName(),
            "factory"    => (new FactoryAction(
                $database,
                $table
            ))->getQualifiedName(),
        ];
    }

    /**
     * Insert row in table.
     *
     * @param Request $request
     *
     * @return array
     */
    public function insertNewRow(Request $request): array
    {
        try {
            // PDB::create($request->database, $request->table)->builder()->insert($request->post('data'));
        } catch (Exception $e) {
            dd($e);
        }

        return [
            "success" => (bool)(new DatabaseAction(
                $request->database,
                $request->table
            ))->insertNewRow($request->post("data")),
        ];
    }

    /**
     * Run raw SQL query.
     *
     * @param Request $request
     *
     * @return array|Query
     */
    public function runSql(Request $request)
    {
        return (new Query($request))->get();
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
     *
     * @return array
     */
    public function status()
    {
        return (new AppStatus())->getStatus();
    }

    /**
     * Run pending migrations.
     *
     * @param string $database
     * @param string $table
     *
     * @return int
     */
    public function runMigrations(string $database, string $table)
    {
        return (new MigrationAction($database, $table))->run();
    }

    /**
     * Reset latest migrations.
     *
     * @param string $database
     * @param string $table
     *
     * @return int
     */
    public function resetMigrations(string $database, string $table)
    {
        return (new MigrationAction($database, $table))->reset();
    }

    /**
     * Generate controller.
     *
     * @param string $database
     * @param string $table
     *
     * @return mixed
     * @throws Exception
     */
    public function generateController(string $database, string $table)
    {
        return (new ControllerAction($database, $table))->generate();
    }

    /**
     * Generate factory.
     *
     * @param string $database
     * @param string $table
     *
     * @return int|string
     * @throws Exception
     */
    public function generateFactory(string $database, string $table)
    {
        return (new FactoryAction($database, $table))->generate();
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
        return (new ModelAction($database, $table))->generate();
    }

    /**
     * Generate resource.
     *
     * @param string $database
     * @param string $table
     *
     * @return mixed
     * @throws Exception
     */
    public function generateResource(string $database, string $table)
    {
        return (new ResourceAction($database, $table))->generate();
    }

    /**
     * Generate seeder.
     *
     * @param string $database
     * @param string $table
     *
     * @return int|string
     * @throws Exception
     */
    public function generateSeeder(string $database, string $table)
    {
        return (new SeederAction($database, $table))->generate();
    }

    /**
     * Run seeder.
     *
     * @param string $database
     * @param string $table
     *
     * @return int
     * @throws Exception
     */
    public function runSeeder(string $database, string $table)
    {
        return (new SeederAction($database, $table))->run();
    }
}
