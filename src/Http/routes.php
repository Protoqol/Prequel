<?php

use Illuminate\Support\Facades\Route;

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
     ->group(function () {
         Route::get("/", "PrequelController@index")->name("index");
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
     ->group(function () {
         // Get database status, includes number of migrations, avg. queries per second, open tables etc.
         Route::get("status", "DatabaseActionController@status");

         // Get latest Prequel version
         Route::get("version", "PrequelController@version");

         // Update Prequel to latest version
         Route::post("update", "PrequelController@autoUpdate");

         // Database related routes
         Route::prefix("database")->group(function () {
             // Default data retrieval
             Route::get("get/{database}/{table}", "DatabaseController@getTableData");
             Route::get("count/{database}/{table}", "DatabaseController@count");
             Route::get("find/{database}/{table}/{column}/{type}/{value}", "DatabaseController@findInTable");

             // MigrationAction, run or reset
             Route::get("migrations/run", "DatabaseActionController@runMigrations");
             Route::get("migrations/reset", "DatabaseActionController@resetMigrations");

             // Get information related to management functionality, ex. has model/factory/seeder etc.
             Route::get("info/{database}/{table}", "DatabaseActionController@getInfoAboutTable");

             // Get default values for new row form, ex. next AI-ID, date-times etc.
             Route::get("defaults/{database}/{table}", "DatabaseActionController@getDefaultsForTable");

             // Insert new row
             Route::post("insert/{database}/{table}", "DatabaseActionController@insertNewRow");

             // Controller Actions
             Route::get("controller/{database}/{table}/generate", "DatabaseActionController@generateController");

             // Factory Actions
             Route::get("factory/{database}/{table}/generate", "DatabaseActionController@generateFactory");

             // Model Actions
             Route::get("model/{database}/{table}/generate", "DatabaseActionController@generateModel");

             // Resource Actions
             Route::get("resource/{database}/{table}/generate", "DatabaseActionController@generateResource");

             // Seeder Actions
             Route::get("seeder/{database}/{table}/generate", "DatabaseActionController@generateSeeder");
             Route::get("seeder/{database}/{table}/run", "DatabaseActionController@runSeeder");


             // Raw SQL Query
             Route::post("sql/{database}/{table}/run", "DatabaseActionController@runSql");
         });
     });
