<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Meeting;
use Illuminate\Console\Command;

class MeetingEnd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:meeting-end';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        //
        $now = Carbon::now('Asia/Makassar');


        Meeting::where('status', 'Rapat Dimulai')
                ->whereDate('end_time', '<=', $now)
                ->update(['status' => 'Selesai']);
    }
}
