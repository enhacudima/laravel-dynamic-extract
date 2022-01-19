<?php

namespace App\Jobs;

use App\Jobs\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Notifications\SystemNotify;
use Notification;
use Auth;

class NotifyUserSystemNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $user;
    public $data;
    public $autor;
    public $tries = 1;

    public function __construct($user,$data)
    {
        $this->user=$user;
        $this->data=$data;
        if (Auth::guest()){
            $autor=null;
        }else{
            $autor=Auth::user()->name.' '. Auth::user()->lname;
        }
        $this->autor=$autor;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Notification::send($this->user, new SystemNotify($this->data,$this->autor));
    }
}
