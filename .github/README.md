
![Prequel](assets/prequel_v1.png)  

<p align="center">
    <a href="https://packagist.org/packages/protoqol/prequel">	
       <img alt="Packagist Version" src="https://img.shields.io/packagist/v/protoqol/prequel.svg">
    </a>
    <a href="https://travis-ci.org/Protoqol/Prequel.svg?branch=Dev">
	    <img src="https://travis-ci.org/Protoqol/Prequel.svg?branch=master"/>	
    </a>
    <a href="https://packagist.org/packages/protoqol/prequel">
	    <img src="https://img.shields.io/badge/php-%5E7.1-lightblue.svg"/>	
    </a>
    <a href="https://laravel.com/">
	    <img src="https://img.shields.io/badge/laravel-%5E5.6-lightblue.svg"/>	
    </a>
    <a href="https://github.com/badges/shields/pulse" alt="Activity">
        <img src="https://img.shields.io/github/commit-activity/m/badges/shields.svg" />
    </a>
    <a href="https://twitter.com/intent/follow?screen_name=Protoqol_XYZ">
        <img src="https://img.shields.io/twitter/follow/Protoqol_XYZ.svg?label=%40Protoqol_XYZ&style=social"
            alt="follow on Twitter">
    </a>
</p>

#### What is Prequel exactly?  
Prequel is meant to be a database management tool for Laravel to replace the need for separate standalone database tools like phpMyAdmin, Sequel Pro or MySQL Workbench. With its (hopefully) clear and concise UI, Prequel is to be a modern and lightweight database browser/tool ready for the web of the future. Prequel's design is purposefully based on that of [Laravel Telescope](https://github.com/laravel/telescope) because (web-)developers today have enough to learn and master already, so let's help eachother out and make sure to not add anything virtually useless to that huge pile of knowledge.   
  
![Prequel Screenshot](./assets/prequel_screenshot_table.png)  
> Clear and concise database management  
  
## Installation
###### To install follow the instructions below.  
```bash  
$ composer require protoqol/prequel  
$ php artisan prequel:install
```  
###### When installation and publishing is done navigate to `/prequel` in your browser to see Prequel in action!

## Updating
###### To update you can use the command specified below.
```bash
$ php artisan prequel:update
```
  
#### Issues, bugs and feature requests can be reported [here!](https://github.com/Protoqol/Prequel/issues/new/choose)  

## Configuration
You might have noticed that, while publishing a config file appeared under `config/prequel.php`. 
That configuration file looks something like this.
> Note that you can define `PREQUEL_ENABLED` in your .env file.
```php
[  

    /*  
    |--------------------------------------------------------------------------  
    | Prequel Master Switch : boolean
    |--------------------------------------------------------------------------  
    |  
    | Manually disable/enable Prequel, if in production Prequel will always  
    | be disabled. Reason being that nobody should ever be able to directly look  
    | inside your database besides you or your dev team (obviously).  
    |  
    */
    'enabled'      => env('PREQUEL_ENABLED', true),  
      
    /*  
    |--------------------------------------------------------------------------  
    | Prequel Path : string
    |--------------------------------------------------------------------------  
    |  
    | The path where Prequel will be residing. Note that this does not affect 
    | Prequel API routes.  
    |  
    */
    'path'         => 'prequel',  
    
    /*  
    |--------------------------------------------------------------------------  
    | Prequel Database Configuration : array
    |--------------------------------------------------------------------------  
    |  
    | This enables you to fully configure your database-connection for Prequel.
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
    | Using 'mysql' => ['*'] ignores the entire mysql database.
    | Using 'mysql' => ['foo']  ignores only the mysql.foo table.
    */
    'ignored'      => [  
         // 'information_schema'  => ['*'],  
         // 'sys'                 => ['*'],
         // 'performance_schema'  => ['*'], 
         // 'mysql'               => ['*'],
         '#mysql50#lost+found'    => ['*'],  
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
```
  
![Prequel Screenshot](./assets/prequel_screenshot.png)  
> Clear and concise database management  

## Contributing
See [Contributing](CONTRIBUTING.md) to see how you can contribute to Prequel!   
  
  
## Contributors  
- [Quinten Schorsij](https://github.com/QuintenJustus)  
- [Contributors](https://github.com/Protoqol/Prequel/graphs/contributors)  
  
## License  
  
Prequel is licensed under the MIT License. Please see [License File](LICENSE) for more information.
