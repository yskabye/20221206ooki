<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ConfirmMail;
use Carbon\Carbon;

class ConfirmSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'confirm:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '確認メール送信';

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
        Log::info('Confirm Mail Send Start : ' . Carbon::now());

        $sql = "select customers.name, customers.email, reserves.reserve_time, " .
               "shopinfos.shopname, shopinfos.staffname, shopinfos.staffemail, " .
               "reserves.people_num from reserves " .
               "inner join users customers on customers.id = reserves.user_id " .
               "inner join (select restrants.id, restrants.name shopname, " .
               "staffs.name staffname, staffs.email staffemail from restrants " .
               "inner join users staffs on restrants.id = staffs.restrant_id) " .
               "shopinfos on shopinfos.id = reserves.restrant_id ".
               "where reserve_date = '" . Carbon::today() . "'" ;

        $users = \DB::select($sql);

        foreach($users as $user){
            $user->reserve_time = new Carbon($user->reserve_time);
            $to = [['email' => $user->email, 'name' => $user->name . " 様"]];

            Mail::to($to)
                ->send(new ConfirmMail(
                        $user->staffemail,
                        $user->staffname,
                        $user->name,
                        $user->shopname,
                        $user->reserve_time,
                        $user->people_num,
                    ));
        }

        Log::info('Confirm Mail Send End : ' . Carbon::now());

        return 0;
    }
}
