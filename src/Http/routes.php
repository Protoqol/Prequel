<?php

use Illuminate\Support\Facades\Route;
use Protoqol\Prequel\Classes\App\Migrations;

Route::namespace('Protoqol\Prequel\Http\Controllers')
     ->middleware([Protoqol\Prequel\Http\Middleware\Authorised::class])
     ->prefix(config('prequel.path'))
     ->name('prequel.')
     ->group(function () {
         Route::get('/', 'PrequelController@index')->name('index');
     });

Route::namespace('Protoqol\Prequel\Http\Controllers')
     ->middleware([Protoqol\Prequel\Http\Middleware\Authorised::class])
     ->prefix('prequel-api')
     ->name('prequel.')
     ->group(function () {
         Route::prefix('database')->group(function () {

             // Get data from table, data includes structure, actual data and table name.
             Route::get('get/{database}/{table}', 'DatabaseController@getTableData');

             // Get count of total records in table
             // Note: Unused as of yet.
             Route::get('count/{database}/{table}', 'DatabaseController@countTableRecords');

             // Find data with given input
             Route::get('find/{database}/{table}/{column}/{type}/{value}', 'DatabaseController@findInTable');

         });

         /**
          * Get app status.
          */
         Route::get('status', 'PrequelController@status');

         Route::get('run/migrations', function () {
             return (new Migrations())->run();
         });

         Route::get('reset/migrations', function () {
             return (new Migrations())->reset();
         });
     });
