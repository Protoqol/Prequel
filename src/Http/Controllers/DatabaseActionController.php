<?php

    namespace Protoqol\Prequel\Http\Controllers;

    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\DB;

    class DatabaseActionController extends Controller {

        public function getTableData(string $database, string $table) {
            return [
                "table"     => "$database.$table",
                "structure" => DB::select("SHOW COLUMNS FROM $database.$table"),
                "data"      => DB::table("$database.$table")->get(),
            ];
        }

        public function delete() {
            //
        }
    }
