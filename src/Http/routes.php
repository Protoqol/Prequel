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
                Route::get(
                    '{database}/{table}/columns/get',
                    'DatabaseActionController@getTableData'
                );
                Route::get(
                    '{database}/{table}/count/get',
                    'DatabaseActionController@countTableRecords'
                );
            });
        });
    });
