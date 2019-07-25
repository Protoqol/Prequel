<?php

declare(strict_types = 1);

namespace Protoqol\Prequel\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Protoqol\Prequel\Classes\App\AppStatus;
use Protoqol\Prequel\Classes\App\Migrations;
use Protoqol\Prequel\Classes\Database\DatabaseConnector;
use Protoqol\Prequel\Classes\Database\DatabaseTraverser;
use Protoqol\Prequel\Facades\PDB;

/**
 * Class DatabaseActionController
 * @package Protoqol\Prequel\Http\Controllers
 */
class DatabaseActionController extends Controller
{
    /*
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
        return (new Migrations())->run();
    }

    /**
     * Reset latest migrations.
     * @return int
     */
    public function resetMigrations()
    {
        return (new Migrations())->reset();
    }
}
