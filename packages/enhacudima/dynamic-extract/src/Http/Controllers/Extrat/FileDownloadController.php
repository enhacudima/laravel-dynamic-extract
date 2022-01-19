<?php

namespace Enhacudima\DynamicExtract\Controllers\Extrat;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Storage;
use Enhacudima\DynamicExtract\DataBase\Model\ProcessedFiles;

class FileDownloadController extends Controller
{

    public function index($filename) {
    	$data=ProcessedFiles::where('filename',$filename)->first();

        $file = $data->path.$filename;
        return  Storage::download($file);
    }
}
