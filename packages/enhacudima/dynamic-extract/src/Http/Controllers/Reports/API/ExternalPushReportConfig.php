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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:70',
            'comments' => 'required|string|max:255',
            'can' => 'required|string',
            'filtro' => 'nullable|integer',
            'table_name' => 'required|integer',
            'user_id' => 'required|integer',
        ]);
        $error = $this->validate_report($request);
        if (isset($error)) {
            return back()->with('error', $error);
        }

        ReportNew::create($request->all());

        return back()->with('success', 'You have add new report on list');

    }
    public function delete($id)
    {
        $data = ReportNew::find($id);
        $status = 0;
        if ($data->status == 0) {
            $status = 1;
        }

        ReportNew::where('id', $id)
            ->update(['status' => $status]);

        return back()->with('success', 'You changed report on the list');
    }

    public function delete_report($id)
    {
        $data = ReportNew::find($id);
        if (!isset($data)) {
            return back()->with('error', 'This report is no longer available');
        }
        $data->delete();
        return redirect($this->prefix . 'report/new')->with('success', 'Report deleted successfully');
    }
    public function edit($id)
    {
        $data = ReportNew::find($id);
        if (!isset($data)) {
            return back();
        }
        $filtros = ReportNewFiltroGroupo::get();
        $tables = ReportNewTables::get();
        $permissions = '';
        #$permissions=DB::table('permissions')->orderBy('name','asc')->get();

        return view('extract-view::report.config.edit', compact('data', 'filtros', 'tables', 'permissions'));

    }


}
