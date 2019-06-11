<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Prequel Master Switch
    |--------------------------------------------------------------------------
    |
    | Manually disable/enable Prequel, if in production Prequel will always
    | be disabled. Reason being that nobody should ever be able to directly look
    | inside your database (obviously).
    |
    */
    'enabled' => env('PREQUEL_ENABLED', true),


    /*
    |--------------------------------------------------------------------------
    | Prequel Path
    |--------------------------------------------------------------------------
    |
    | The path where Prequel will be residing. Note that this does not affect
    | Prequel API routes.
    |
    */
    'path'    => 'prequel',

    /*
    |--------------------------------------------------------------------------
    | Prequel Database Configuration
    |--------------------------------------------------------------------------
    |
    | Database configuration.
    |
    */
    'DB'      => [
        'CONNECTION' => env('DB_CONNECTION', 'mysql'),
        'HOST'       => env('DB_HOST', '127.0.0.1'),
        'PORT'       => env('DB_PORT', '3306'),
        'DATABASE'   => env('DB_DATABASE', 'homestead'),
        'USERNAME'   => env('DB_USERNAME', 'homestead'),
        'PASSWORD'   => env('DB_PASSWORD', 'secret'),
    ],
];
