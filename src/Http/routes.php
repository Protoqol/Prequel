<?php

    use Illuminate\Support\Facades\Route;

    Route::middleware('Protoqol\Prequel\Http\Middleware\Authorised')->group(function () {
        Route::get('prequel', 'Protoqol\Prequel\Http\Controllers\PrequelController@index');
    });
