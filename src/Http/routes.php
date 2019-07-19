<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Protoqol\Prequel\Http\Controllers')
     ->middleware(config('prequel.middleware'))
     ->prefix(config('prequel.path'))
     ->name('prequel.')
     ->group(function () {

         Route::get('/', 'PrequelController@index')->name('index');

     });

// Separate from web route to avoid user configured path messing up the Prequel-API.
Route::namespace('Protoqol\Prequel\Http\Controllers')
     ->middleware([Protoqol\Prequel\Http\Middleware\Authorised::class])
     ->prefix('prequel-api')
     ->name('prequel.')
     ->group(function () {

         Route::get('status', 'PrequelController@status');

         Route::prefix('database')->group(function () {
             Route::get('get/{database}/{table}', 'DatabaseController@getTableData');
             Route::get('count/{database}/{table}', 'DatabaseController@countTableRecords');
             Route::get('find/{database}/{table}/{column}/{type}/{value}', 'DatabaseController@findInTable');

             Route::get('run', 'DatabaseController@runMigrations');
             Route::get('reset', 'DatabaseController@resetMigrations');
         });

     });
