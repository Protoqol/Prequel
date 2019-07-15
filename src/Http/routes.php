<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Protoqol\Prequel\Http\Controllers')
    ->middleware('Protoqol\Prequel\Http\Middleware\Authorised')
    ->prefix(config('prequel.path'))
    ->name('prequel.')
    ->group(function () {

        /**
         * Main view route
         */
        Route::get('/', 'PrequelController@index')->name('index');


        /**
         * API Routes.
         */
        Route::prefix('prequel-api')->group(function () {
            Route::prefix('database')->group(function () {

                // Get data from table, data includes structure, actual data and table name.
                Route::get(
                    'get/{database}/{table}',
                    'DatabaseController@getTableData'
                );

                // Get count of total records in table
                Route::get(
                    'count/{database}/{table}',
                    'DatabaseController@countTableRecords'
                );

                // Find data with given input
                Route::get(
                    'find/{database}/{table}/{column}/{type}/{value}',
                    'DatabaseController@findInTable'
                );
            });
        });
    });
