<?php

namespace Enhacudima\DynamicExtract\Console\Commands;

use Illuminate\Console\Command;
use Enhacudima\DynamicExtract\DataBase\Model\User;

class AccessRevokeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dynamic-extract:access-revoke {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Configure DynamicExtract revoke user access';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param  \App\Support\DripEmailer  $drip
     * @return mixed
     */
    public function handle()
    {
        $email = $this->ask('What is revoke email?');
        
        $check = User::where('email',$email)->first();
        
        if(!$check){
            $this->error("Could not find any related email");
             $email = $this->ask('What is revoke email?');
        }

        if ($this->confirm('Do you wish to revoke access to '.$email.'?')) {
            $user = User::where('email',$this->argument('user'))->delete();
            $this->info('Revoke link access: '. $email);
        }
        return Command::SUCCESS;
    }
}
