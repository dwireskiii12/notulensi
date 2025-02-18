<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Meeting;
use App\Notifications\MeetingStarted;
use Illuminate\Console\Command;

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

        $updatedToStarted = Meeting::where('status', 'Menunggu Dimulai')
                          ->where('start_time', '<=', $now)
                          ->update(['status' => 'Rapat Dimulai']);

        Log::info("Updated to 'Rapat Dimulai' for $updatedToStarted meetings.");

        $updatedToFinished = Meeting::where('status', 'Rapat Dimulai')
                                ->where('end_time', '<=', $now)
                                ->update(['status' => 'Selesai']);

        Log::info("Updated to 'Selesai' for $updatedToFinished meetings.");
    }
}
