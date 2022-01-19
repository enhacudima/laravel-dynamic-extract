<?php

namespace Enhacudima\DynamicExtract\Http\Controllers\Reports;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;
use Enhacudima\DynamicExtract\DataBase\Model\ProcessedFiles;
use DB;
use Carbon\Carbon;
use App\Exports\RelatorioExport;
use Maatwebsite\Excel\Facades\Excel;
use Enhacudima\DynamicExtract\Jobs\NotifyUserOfCompletedExport;
use File;
use Enhacudima\DynamicExtract\DataBase\Model\ReportNew;
use Storage;


class ExtractControllerReport extends Controller
{

        public function __construct()
    {
    }

  public function index()
  {

      $data=ProcessedFiles::select('processed_files.*','users.name','users.lname','users.avatar')->join('users','processed_files.user_id','users.id')->orderby('processed_files.created_at','desc')->get();

      return view('extract-view::report.index',compact('data'));
  }

      public function deletefile($file)
    {
        $data=ProcessedFiles::where('filename',$file)->first();
        Storage::delete($data->path.$data->filename);
        $data->delete();

        return back();
    }

    public function alldeletefile()
    {
            $files=ProcessedFiles::get();

            foreach ($files as $file)
            {
              Storage::delete($file->path.$file->filename);
            }

            DB::delete('delete from processed_files');
        return back();
    }


    public function new ()
    {
        $data=ReportNew::where('status',1)->orderby('name','asc')->get();
        return view('extract-view::report.new', compact('data'));
    }

    public function filtro(Request $request)
    {
        $end=date('Y-m-d');
        $start=date('Y-m-01');

        if (isset($request->start)) {
              $request->validate([
                  'start'=>'required|date',
              ]);
              $start=Carbon::parse($request->start);
        }
        if (isset($request->end)) {
              $request->validate([
                  'end'=>'required|date'
              ]);
          $end=Carbon::parse($request->end)->endOfDay();
        }

          $type=$request->type;
          $filtro=$request->filtro;
        $new_str = str_replace(' ', '', $request->report_name);
        $filename=$new_str.time().'.xlsx';
        $filterData = $request->except(['_token','can','report_id']);
        //dd($filterData);
        $data=[];
        $data['filename']=$filename;
        $data['user_id']=Auth::user()->id ?? 0;
        $data['can']=$request->can;
        $data['filterData']=$filterData;
        ProcessedFiles::create($data);
        //Excel::download(new RelatorioExport($start,$end,$type,$filtro,$request->all()), 'users.xlsx');
        try{

          (new RelatorioExport($start,$end,$type,$filtro,$request->all()))->queue($filename)->chain([
              new NotifyUserOfCompletedExport(request()->user(),$filename),
          ]);

        }catch (Exception $e) {
            return back()->with('error','Error: '.$e->getMessage());
        }



        return Redirect(url('/report/index'))->withSuccess('Export starting..');

    }



}
