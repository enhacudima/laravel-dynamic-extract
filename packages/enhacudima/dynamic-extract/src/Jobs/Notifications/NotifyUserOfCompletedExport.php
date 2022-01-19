<?php
namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use App\Notifications\ExportReady;
use App\ProcessedFiles;
use Storage;

class NotifyUserOfCompletedExport implements ShouldQueue
{
    use Queueable, SerializesModels;
    
    public $user;
    public $filename;
    
    public function __construct(User $user,$filename)
    {
        $this->user = $user;
        $this->filename=$filename;
    }

    public function handle()
    {   

        $data=ProcessedFiles::where('filename',$this->filename)->first();
        $data->status=0;
        $data->path='excel/exports/';
        $data->save(); 
        Storage::move($this->filename, 'excel/exports/'.$this->filename);
       

        $this->user->notify(new ExportReady($this->filename));
    }
}
