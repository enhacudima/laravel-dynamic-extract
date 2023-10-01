<?php

namespace Enhacudima\DynamicExtract\Http\Controllers\Reports\API;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Enhacudima\DynamicExtract\DataBase\Model\Access;
use Enhacudima\DynamicExtract\DataBase\Model\ReportNewApiExternalPushData;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class ExternalPushReport extends Controller
{

    public $user_id;
    public $user_model;
    public $prefix;
    public $maxPage = 2;
    public function __construct()
    {
        $this->prefix = config('dynamic-extract.prefix');
    }


    public function index($uuid)
    {
        $table = $this->signIn($uuid);

        if($table->advance_query == 1){
            $test = $this->validateQuery($table->text_query);
            if (!$test)
                abort(401);
            $query = DB::connection(config('dynamic-extract.db_connection'))->select($table->text_query);
            if($table->paginate == 1){
                $data = new Paginator($query, $this->maxPage);
            }else {
                $data = $query;
            }
        }else {
            $query = DB::connection(config('dynamic-extract.db_connection'))->table($table->table->table_name);
            if ($table->paginate == 1) {
                $data = $query->paginate($this->maxPage);
            } else {
                $data = $query->get();
            }
        }
        return response()->json($data);
    }
    public function signIn($uuid)
    {
        // Authenticate the user
        $user = ReportNewApiExternalPushData::query()
            ->with('table')
            ->where('access_link',$uuid)
            ->where('status', 1)
            ->firstOrFail();
        return $user;
    }
    public function validateQuery($query)
    {
        return true;
    }


}
