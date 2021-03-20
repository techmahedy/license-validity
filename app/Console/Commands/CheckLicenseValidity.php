<?php

namespace App\Console\Commands;

use App\Models\License;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckLicenseValidity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'license:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checking automatically all the users license validity!';

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
        $users = User::with('license')->get();
        $today = Carbon::today();
        $todays_date = $today->toDateString();
        foreach ($users as $user) {
            if($user->hasLicense($user->id)){
                if($todays_date > $user->license->expire_date ){
                    License::where('user_id',$user->id)
                           ->delete();
                }
            }
        }
    }
}
