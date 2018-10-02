<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CronJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CronJob:cronjob';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'User Name Change Successfully';

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
     * @return mixed
     */
    public function handle()
    {
        $groups =  \DB::table('groups')
            ->where('status', "Cancelled")
            ->whereRaw('Date(cancel_date) = CURDATE()')
            ->get();
        foreach ($groups as $key => $value) {
           \DB::table('conversations')
            ->where('group_id', $value->id)
            ->delete();
        }
        $this->info('User Name Change Successfully!');
    }
}
