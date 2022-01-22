<?php
namespace Enhacudima\DynamicExtract\Jobs\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Enhacudima\DynamicExtract\Notifications\ImportReady;

class NotifyUserOfCompletedImport implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $filename;

    public function __construct(User $user,$filename)
    {
        $this->user = $user;
        $this->filename = $filename;
    }

    public function handle()
    {
        $this->user->notify(new ImportReady($this->filename));
    }
}
