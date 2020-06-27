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
        | Prequel Locale : string
        |--------------------------------------------------------------------------
        |
        | Choose what language Prequel should display in.
        |
        */
        
        'locale' => env('APP_LOCALE', 'en'),
        
        
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
        | Laravel asset generation suffix and namespace definition
        |--------------------------------------------------------------------------
        |
        | Here you can define your preferred asset suffixes and directory/namespaces.
        | Separate with a double backwards slash to define namespace and directory
        | location. Everything after the last '\\' will be treated as a suffix.
        | Note that the backslash needs to be escaped with an extra backslash
        |
        | For example
        |
        |  Configuration
        |     'suffixes' => [
        |           'model'  => 'Models\\Model',
        |           'seeder' => 'MyMadeUpSeederSuffix'
        |       ]
        |
        |  When generating for `users` table
        |     (directory) app/models/UserModel.php
        |     (qualified class) App\Models\UserModel
        |     (directory) database/seeds/UserMyMadeUpSeederSuffix.php
        |
        */
        
        'suffixes' => [
            'model'      => 'Models\\',
            'seeder'     => 'Seeder',
            'factory'    => 'Factory',
            'controller' => 'Controller',
            'resource'   => 'Resource',
        ],
        
        
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
            '#mysql50#lost+found' => ['*'],
            
            // -- Frequently ignored tables --
            // 'information_schema'  => ['*'],
            // 'sys'                 => ['*'],
            // 'performance_schema'  => ['*'],
            // 'mysql'               => ['*'],
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
