<?php

namespace App\Console\Commands;

use App\Mail\SendEmail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class CampaignCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'campaign:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Broadcast Campaign mail to users daily';

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
     * @return int
     */
    public function handle()
    {
        //return Command::SUCCESS;
        $users = User::all();
        if (count($users) > 0) {
            foreach($users as $user) {
                Mail::to($user->email)->send(new SendEmail);
            }
        }
    }

    public function __invoke(){
        //return Command::SUCCESS;
        $users = User::all();
        if (count($users) > 0) {
            foreach($users as $user) {
                Mail::to($user->email)->send(new SendEmail);
            }
        }
    }


}
