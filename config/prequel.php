<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Prequel Master Switch : boolean
    |--------------------------------------------------------------------------
    |
    | Manually disable/enable Prequel, if in production Prequel will always be
    | disabled. Reason being that nobody should ever be able to directly look
    | inside your database besides you or your dev team (obviously).
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

    'path' => 'prequel',

    /*
    |--------------------------------------------------------------------------
    | Prequel Database Configuration : array
    |--------------------------------------------------------------------------
    |
    | This enables you to fully configure your database connection for Prequel.
    |
    */

    'database' => [
        'connection' => env('DB_CONNECTION', 'mysql'),
        'host'       => env('DB_HOST', '127.0.0.1'),
        'port'       => env('DB_PORT', '3306'),
        'database'   => env('DB_DATABASE', 'homestead'),
        'username'   => env('DB_USERNAME', 'homestead'),
        'password'   => env('DB_PASSWORD', 'secret'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Prequel ignored databases and tables : array
    |--------------------------------------------------------------------------
    | Databases and tables that will be ignored during database discovery.
    |
    | Using 'mysql' => ['foo']  ignores only the mysql.foo table.
    | Using 'mysql' => ['*'] ignores the entire mysql database.
    |
    */

    'ignored' => [
        // 'information_schema'  => ['*'],
        // 'sys'                 => ['*'],
        // 'performance_schema'  => ['*'],
        // 'mysql'               => ['*'],
        '#mysql50#lost+found' => ['*'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Prequel pagination per page : integer
    |--------------------------------------------------------------------------
    |
    | When Prequel retrieves paginated information, this is the number of
    | records that will be in each page.
    |
    */

    'pagination' => 100,

    /*
    |--------------------------------------------------------------------------
    | Prequel middleware : array
    |--------------------------------------------------------------------------
    |
    | Define custom middleware for Prequel to use.
    |
    | Ex. 'web', Protoqol\Prequel\Http\Middleware\Authorised::class
    |
    */

    'middleware' => [
        Protoqol\Prequel\Http\Middleware\Authorised::class,
    ],
];
