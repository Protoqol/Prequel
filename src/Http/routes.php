<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Protoqol\Prequel\Http\Controllers')
    ->middleware('Protoqol\Prequel\Http\Middleware\Authorised')
    ->prefix(config('prequel.path'))
    ->group(function () {

        /**
         * Main view route
         */
        Route::get('/', 'PrequelController@index');


        /**
         * API Routes.
         */
        Route::prefix('prequel-api')->group(function () {
            Route::prefix('database')->group(function () {

                // Get data from table, data includes structure, actual data and table name.
                Route::get(
                    '{database}/{table}/data/get',
                    'DatabaseController@getTableData'
                );

                // Find data with given input
                Route::get(
                    '',
                    'DatabaseController@findInTable'
                );

                // Get count of total records in table
                Route::get(
                    '{database}/{table}/count/get',
                    'DatabaseController@countTableRecords'
                );
            });
        });
    });
