<?php
    
    
    namespace Protoqol\Prequel\Http\Controllers;
    
    use Illuminate\Routing\Controller;
    use Illuminate\Support\Facades\Lang;
    use Protoqol\Prequel\Database\DatabaseTraverser;
    
    /**
     * Class PrequelController
     * @package Protoqol\Prequel\Http\Controllers
     */
    class PrequelController extends Controller
    {
        
        /**
         * Get first entry data
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function index()
        {
            $databaseData = (object)app(DatabaseTraverser::class)->getAll();
            
            return view('Prequel::main', [
                'env'  => [
                    'connection' => config('prequel.database.connection'),
                    'database'   => config('prequel.database.database'),
                    'host'       => config('prequel.database.host'),
                    'port'       => config('prequel.database.port'),
                    'user'       => config('prequel.database.username'),
                ],
                'data' => [
                    'collection'          => $databaseData->collection,
                    'flatTableCollection' => $databaseData->flatTableCollection,
                ],
                'lang' => Lang::get('Prequel::lang', [], (string)config('prequel.locale')),
            ]);
        }
        
        /**
         * Get latest Prequel version, uses Curl instead of Guzzle because adding a dependency just for version checking is a bit much.
         * @return void
         */
        public function version()
        {
            header('Content-Type: application/json', true);
            
            $ch = curl_init('https://api.github.com/repos/protoqol/prequel/tags');
            
            curl_setopt_array($ch, [
                CURLOPT_USERAGENT      => 'Protoqol-Prequel',
                CURLOPT_RETURNTRANSFER => 1,
            ]);
            
            $output = curl_exec($ch);
            
            curl_close($ch);
            
            echo json_encode($output);
        }
    }
