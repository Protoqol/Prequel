<?php

use Illuminate\Support\Facades\Route;
use Protoqol\Prequel\Http\Controllers\DatabaseActionController;
use Protoqol\Prequel\Http\Controllers\DatabaseController;
use Protoqol\Prequel\Http\Controllers\PrequelController;

/**
 * |-----------------------------------------
 * |  Prequel Web Routes /prequel or via config.
 * |-----------------------------------------
 * |
 * | Separate from web route to avoid user configured path messing up the Prequel-API.
 * |
 */
Route::namespace("Protoqol\Prequel\Http\Controllers")
     ->middleware(config("prequel.middleware"))
     ->prefix(config("prequel.path"))
     ->name("prequel.")
     ->group(static function () {
         Route::get("/", [PrequelController::class, 'index'])->name("index");
     });

/**
 * |-----------------------------------------
 * |  Prequel API Routes /prequel-api
 * |-----------------------------------------
 * |
 * | Separate from web route to avoid user configured path messing up the Prequel-API.
 * |
 */
Route::namespace("Protoqol\Prequel\Http\Controllers")
     ->middleware(config("prequel.middleware"))
     ->prefix("prequel-api")
     ->name("prequel.")
     ->group(static function () {
         // Get database status, includes number of migrations, avg. queries per second, open tables etc.
         Route::get("status", [DatabaseActionController::class, 'status']);

         // Update Prequel to latest version
         Route::post("update", [PrequelController::class, 'autoUpdate']);

         // Database related routes
         Route::prefix("database")->group(static function () {
             // Default data retrieval
             Route::get("get/{database}/{table}", [DatabaseController::class, 'getTableData',]);
             Route::get("count/{database}/{table}", [DatabaseController::class, 'count',]);
             Route::get("find/{database}/{table}/{column}/{type}/{value}", [DatabaseController::class, 'findInTable',]);

             // MigrationAction, run or reset
             Route::get("migrations/run", [DatabaseActionController::class, 'runMigrations',]);
             Route::get("migrations/reset", [DatabaseActionController::class, 'resetMigrations',]);

             // Get information related to management functionality, ex. has model/factory/seeder etc.
             Route::get("info/{database}/{table}", [DatabaseActionController::class, 'getInfoAboutTable',]);

             // Get default values for new row form, ex. next AI-ID, date-times etc.
             Route::get("defaults/{database}/{table}", [DatabaseActionController::class, 'getDefaultsForTable',]);

             // Insert new row
             Route::post("insert/{database}/{table}", [DatabaseActionController::class, 'insertNewRow',]);

             // Controller Actions
             Route::get("controller/{database}/{table}/generate",
                 [DatabaseActionController::class, 'generateController']);

             // Factory Actions
             Route::get("factory/{database}/{table}/generate", [DatabaseActionController::class, 'generateFactory',]);

             // Model Actions
             Route::get("model/{database}/{table}/generate", [DatabaseActionController::class, 'generateModel',]);

             // Resource Actions
             Route::get("resource/{database}/{table}/generate", [DatabaseActionController::class, 'generateResource',]);

             // Seeder Actions
             Route::get("seeder/{database}/{table}/generate", [DatabaseActionController::class, 'generateSeeder',]);
             Route::get("seeder/{database}/{table}/run", [DatabaseActionController::class, 'runSeeder',]);

             // Raw SQL Query
             Route::post("sql/{database}/{table}/run", [DatabaseActionController::class, 'runSql',]);

             // Export / import
             Route::post('sql/{database}/{table}/export', [DatabaseController::class, 'export',]);
             Route::post('sql/{database}/{table}/import', [DatabaseController::class, 'import',]);
         });
     });
