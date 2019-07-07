<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Prequel Master Switch
    |--------------------------------------------------------------------------
    |
    | Manually disable/enable Prequel, if in production Prequel will always
    | be disabled. Reason being that nobody should ever be able to directly look
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

    /*
    |--------------------------------------------------------------------------
    | Prequel ignored databases and tables
    |--------------------------------------------------------------------------
    |
    | Databases and tables that will be ignored during database discovery
    |
    | Example to ignore 'foo_database.users' and 'foo_database.password_resets':
    |
    |  'foo_database' => [
    |         'users',
    |         'password_resets'
    |  ]
    |
    | Example to ignore the entire database using a wildcard
    |
    | 'foo_database' => [ '*' ]
    |
    */
    'ignored' => [
        // 'information_schema'  => ['*'],
        // 'sys'                 => ['*'],
        // 'performance_schema'  => ['*'],
        // 'mysql'               => ['*'],
        '#mysql50#lost+found' => ['*'],
        'bookeep' => ['empty_table']
    ],
];
