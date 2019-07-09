
![Laravel Prequel](./assets/prequel.png)  
  
# Laravel Prequel 0.6.2-beta  
<p align="center">
    <a href="https://scrutinizer-ci.com/g/Protoqol/Prequel/?branch=master">
	<img src="https://scrutinizer-ci.com/g/Protoqol/Prequel/badges/quality-score.png?=master"/>	
    </a>
    <a href="https://github.com/protoqol/prequel/graphs/contributors" alt="Contributors">
        <img src="https://img.shields.io/github/contributors/protoqol/prequel.svg" />
     </a>
    <a href="https://github.com/badges/shields/pulse" alt="Activity">
        <img src="https://img.shields.io/github/commit-activity/m/badges/shields.svg" />
    </a>
    <a href="https://discord.gg/vZpwDVU">
        <img src="https://img.shields.io/discord/598160569660342327.svg?logo=discord"
            alt="chat on Discord">
     </a>
    <a href="https://twitter.com/intent/follow?screen_name=Protoqol_XYZ">
        <img src="https://img.shields.io/twitter/follow/Protoqol_XYZ.svg?label=%40Protoqol_XYZ&style=social"
            alt="follow on Twitter">
      </a>
</p>

#### What is Laravel Prequel exactly?  
Laravel Prequel is meant to be a database management tool to replace the need for separate standalone database tools like phpMyAdmin, Sequel Pro or MySQL Workbench. With its (hopefully) clear and concise UI, Prequel is to be a modern and lightweight database browser/tool ready for the web of the future. Prequel's design is purposefully based on that of [Laravel Telescope](https://github.com/laravel/telescope) because (web-)developers today have enough to learn and master already, so let's help eachother out and make sure to not add anything virtually useless to that huge pile of knowledge.   
  
![Prequel Screenshot](./assets/prequel_screenshot.png)  
> Clear and concise database management  
  
#### Laravel Prequel (Beta)  
Laravel Prequel has entered/surpassed v0.5.0-beta, that means I deemed it ready enough to be tested by the public.  
But note that a beta release is still a beta release and is not a stable release so it is definitely not recommended to be used in production environments.   
  
Luckily, Prequel has taken precautions, Prequel automatically disables itself in a production environment as people looking directly into your database is - let's just say - not ideal.  
  
The beta only supports `MySQL` for now. But support for `PostgreSQL` is coming soon!
  
## Installation (the beta release way)  
###### To install follow the instructions below.  
```bash  
$ composer require protoqol/prequel  
$ php artisan vendor:publish --tag=config  
$ php artisan vendor:publish --tag=public  
```  
###### When installation and publishing is done navigate to `/prequel` in your browser to see Prequel in action!  
  
#### Issues, bugs and feature requests can be reported [here!](https://github.com/Protoqol/Prequel/issues/new/choose)  

## Configuration
You might have noticed that, while publishing a config file appeared under `config/prequel.php`. 
That configuration file looks something like this.
```php
[  

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
'enabled'      => env('PREQUEL_ENABLED', true),  
  
/*  
|--------------------------------------------------------------------------  
| Prequel Path  
|--------------------------------------------------------------------------  
|  
| The path where Prequel will be residing. Note that this does not affect  
| Prequel API routes.  
|  
*/
'path'         => 'prequel',  

/*  
|--------------------------------------------------------------------------  
| Prequel Database Configuration  
|--------------------------------------------------------------------------  
|  
| This enables you to fully configure your database-connection for Prequel.
|  
*/
'DB' => [  
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
];
```
  
## Contributing  
  
See [Contributing](CONTRIBUTING.md) to see how you can contribute to Prequel!   
  
  
## Contributors  
- [Quinten Schorsij](https://github.com/QuintenJustus)  
- [Contributors](https://github.com/Protoqol/Prequel/graphs/contributors)  
  
## License  
  
Prequel is licensed under the MIT License. Please see [License File](LICENSE) for more information.
