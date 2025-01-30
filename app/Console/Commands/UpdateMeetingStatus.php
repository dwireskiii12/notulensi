<?php

namespace App\Console\Commands;

use Log;
use Carbon\Carbon;
use App\Models\Meeting;
// use Commands\UpdateMeetingStatus;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateMeetingStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-meeting-status';



    /**
     * The console command description.
     *
     * @var string
     */
    // protected $signature = 'meeting:update-status';
    protected $description = 'Update meeting statuses based on current time';

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {

        $now = Carbon::now('Asia/Makassar');

        // Meetings to start
        // Meeting::where('status', 'Menunggu Dimulai')
        //     ->whereDate('start_time', '<=', $now)
        //     ->update(['status' => 'Rapat Dimulai']);

        $updatedToStarted = Meeting::where('status', 'Menunggu Dimulai')
                          ->where('start_time', '<=', $now)
                          ->update(['status' => 'Rapat Dimulai']);
        \Log::info("Updated to 'Rapat Dimulai' for $updatedToStarted meetings.");

        $updatedToFinished = Meeting::where('status', 'Rapat Dimulai')
                                ->where('end_time', '<=', $now)
                                ->update(['status' => 'Selesai']);
        \Log::info("Updated to 'Selesai' for $updatedToFinished meetings.");

    }
}
