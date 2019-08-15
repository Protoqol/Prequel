<?php
    
    use Illuminate\Support\Facades\Route;
    
    /**
     * |-----------------------------------------
     * |  Prequel Web Routes /prequel or via config.
     * |-----------------------------------------
     * |
     * | Separate from web route to avoid user configured path messing up the Prequel-API.
     * |
     */
    Route::namespace('Protoqol\Prequel\Http\Controllers')
         ->middleware(config('prequel.middleware'))
         ->prefix(config('prequel.path'))
         ->name('prequel.')
         ->group(function () {
        
             Route::get('/', 'PrequelController@index')->name('index');
        
         });
    
    /**
     * |-----------------------------------------
     * |  Prequel API Routes /prequel-api
     * |-----------------------------------------
     * |
     * | Separate from web route to avoid user configured path messing up the Prequel-API.
     * |
     */
    Route::namespace('Protoqol\Prequel\Http\Controllers')
         ->middleware(config('prequel.middleware'))
         ->prefix('prequel-api')
         ->name('prequel.')
         ->group(function () {
        
             // Get database status, includes nr of migrations, avg. queries per second, open tables etc.
             Route::get('status', 'DatabaseActionController@status');
        
             // Get latest Prequel version
             Route::get('version', 'PrequelController@version');
        
             // Database related routes
             Route::prefix('database')->group(function () {
            
                 // Default data retrieval
                 Route::get('get/{database}/{table}', 'DatabaseController@getTableData');
                 Route::get('count/{database}/{table}', 'DatabaseController@count');
                 Route::get('find/{database}/{table}/{column}/{type}/{value}', 'DatabaseController@findInTable');
            
                 // Migrations, run or reset
                 Route::get('migrations/run', 'DatabaseActionController@runMigrations');
                 Route::get('migrations/reset', 'DatabaseActionController@resetMigrations');
            
                 // Get information related to management functionality, ex. has model/factory/seeder etc.
                 Route::get('info/{database}/{table}', 'DatabaseActionController@getInfoAboutTable');
            
                 // Get default values for new row form, ex. next AI-ID, date-times etc.
                 Route::get('defaults/{database}/{table}', 'DatabaseActionController@getDefaultsForTable');
            
                 // Insert new row
                 Route::post('insert/{database}/{table}', 'DatabaseActionController@insertNewRow');
            
                 // Factory
                 Route::get('factory/{database}/{table}/generate', 'DatabaseActionController@generateFactory');
                 Route::get('factory/{database}/{table}/run', 'DatabaseActionController@runFactory');
            
                 // Seeding
                 Route::get('seed/{database}/{table}/generate', 'DatabaseActionController@generateSeeder');
                 Route::get('seed/{database}/{table}/run', 'DatabaseActionController@runSeeder');
            
                 // Model
                 Route::get('model/{database}/{table}', 'DatabaseActionController@generateModel');
             });
        
         });
