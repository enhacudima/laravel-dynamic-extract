<?php

namespace Enhacudima\DynamicExtract\Http\Controllers\Reports\API;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Enhacudima\DynamicExtract\DataBase\Model\Access;
use Enhacudima\DynamicExtract\DataBase\Model\ReportNew;
use Enhacudima\DynamicExtract\DataBase\Model\ReportNewApiExternalPushData;
use Enhacudima\DynamicExtract\DataBase\Model\ReportNewFiltroGroupo;
use Enhacudima\DynamicExtract\DataBase\Model\ReportNewTables;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class ExternalPushReportConfig extends Controller
{

    public $user_id;
    public $user_model;
    public $prefix;
    public function __construct()
    {
        $this->prefix = config('dynamic-extract.prefix');

        if (config('dynamic-extract.auth')) {
            $this->middleware('auth');

            if (config('dynamic-extract.middleware.permission.active')) {
                $this->middleware('can:' . config('dynamic-extract.middleware.extract'));
            }
            $this->user_model = config('dynamic-extract.middleware.model');

        } else {
            $this->middleware(function ($request, $next) {
                $value = $request->cookie('access_user_token');
                $storage = Cookie::get('access_user_token');
                if (!$value or $value != $storage) {
                    return redirect($this->prefix . '/');
                }
                $user = Cookie::get('access_user');
                $user = json_decode($user);
                $this->user_id = $user->id;
                $this->user_model = Enhacudima\DynamicExtract\DataBase\Model\Access::class;

                return $next($request);
            });
        }


    }


    public function index()
    {
        $filtros = ReportNewFiltroGroupo::get();
        $tables = ReportNewTables::get();
        $data = ReportNewApiExternalPushData::query()
            ->with('table')
            ->get();

        return view('extract-view::report.config.api.index', compact('data', 'filtros', 'tables'));
    }


}
