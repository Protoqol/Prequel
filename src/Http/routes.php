<?php

use Illuminate\Support\Facades\Route;


/**
 |-----------------------------------------
 |  Prequel Web Routes /prequel or via config.
 |-----------------------------------------
 |
 | Separate from web route to avoid user configured path messing up the Prequel-API.
 |
*/
Route::namespace('Protoqol\Prequel\Http\Controllers')
     ->middleware(config('prequel.middleware'))
     ->prefix(config('prequel.path'))
     ->name('prequel.')
     ->group(function () {

         Route::get('/', 'PrequelController@index')->name('index');

     });

/**
 |-----------------------------------------
 |  Prequel API Routes /prequel-api
 |-----------------------------------------
 |
 | Separate from web route to avoid user configured path messing up the Prequel-API.
 |
*/
Route::namespace('Protoqol\Prequel\Http\Controllers')
     ->middleware(config('prequel.middleware'))
     ->prefix('prequel-api')
     ->name('prequel.')
     ->group(function () {

         Route::get('status', 'DatabaseActionController@status');

         Route::prefix('database')->group(function () {
             Route::get('get/{database}/{table}', 'DatabaseController@getTableData');
             Route::get('count/{database}/{table}', 'DatabaseController@countTableRecords');
             Route::get('find/{database}/{table}/{column}/{type}/{value}', 'DatabaseController@findInTable');

             Route::get('migrations/run', 'DatabaseActionController@runMigrations');
             Route::get('migrations/reset', 'DatabaseActionController@resetMigrations');
         });

     });
