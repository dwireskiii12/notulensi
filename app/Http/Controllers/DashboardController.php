<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\User;
use App\Models\Meeting;
use App\Models\Summary;
use App\Models\Facilities;
use Illuminate\Http\Request;
use App\Models\MeetingFacility;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //

   public function index(){

        $user = Auth::user();

        // Ambil rapat di mana pengguna adalah participant
        $meetings = Meeting::with(['participants'])
            ->where('status', 'Menunggu Dimulai')
            ->whereHas('participants', function($query) use ($user) {
                $query->where('meeting_participants.user_id', $user->user_id);
            })
            ->get();

        // Format data untuk FullCalendar
        $events = $meetings->map(function ($meeting) {
            return [
                'title' => $meeting->meeting_theme,
                'start' => Carbon::parse($meeting->start_time)->format('Y-m-d\TH:i:s') ,
                'end' => Carbon::parse($meeting->end_time)->format('Y-m-d\TH:i:s')
            ];
        });

        // chart ruangan top
        $meetings = Meeting::select('room_id')
            ->selectRaw('COUNT(*) as meeting_count')
            ->groupBy('room_id')
            ->orderByDesc('meeting_count')
            ->limit(5) // Ambil 5 ruangan teratas
            ->get();

        $chartData = [
            'datasets' => [
                [
                    'data' => $meetings->pluck('meeting_count')->toArray(),
                    'backgroundColor' => ['#ee5b5b', '#fcd53b', '#0bdbb8', '#464dee', '#0ad7f7'],
                    'borderColor' => ['#ee5b5b', '#fcd53b', '#0bdbb8', '#464dee', '#0ad7f7'],
                ]
            ],
            'labels' => $meetings->pluck('rooms.room_name')->toArray(),
        ];


        $top5Months = Meeting::select(DB::raw('EXTRACT(MONTH FROM start_time) as month'), DB::raw('COUNT(*) as meeting_count'))
                    ->where('status', 'Selesai') // Filter berdasarkan status meeting selesai
                    ->groupBy(DB::raw('EXTRACT(MONTH FROM start_time)'))
                    ->orderByDesc('meeting_count')
                    ->limit(5)
                    ->get();

        // Mengumpulkan data untuk chart
        $meetingChartData = [
                            'labels' => $top5Months->pluck('month')->map(function ($month) {
                                        return \DateTime::createFromFormat('!m', $month)->format('F');
                             })->toArray(),
        'datasets' => [[
                    'label' => 'Meetings',
                    'data' => $top5Months->pluck('meeting_count')->toArray(),
                    'backgroundColor' => [
                                        '#8169f2',
                                        '#6a4df5',
                                        '#4f2def',
                                        '#2b0bc5',
                                        '#180183',
                                    ],
                    'borderColor' => [
                                        '#8169f2',
                                        '#6a4df5',
                                        '#4f2def',
                                        '#2b0bc5',
                                        '#180183',
                                        ],
                    'borderWidth' => 2,
                    'fill' => false,
                     ]]];

        $facilitiesData = MeetingFacility::select(DB::raw('facilities_name as label, COUNT(*) as data'))
        ->groupBy('facilities_name')
        ->orderByDesc('data')
        ->take(4) // Ambil hanya 4 fasilitas teratas
        ->get();

        // Format data untuk Chart.js
        $facility = [
        'datasets' => [
                        [
                        'data' => $facilitiesData->pluck('data')->toArray(),
                        'backgroundColor' => [
                            '#ee5b5b',
                            '#fcd53b',
                            '#0bdbb8',
                            '#464dee',
                        ],
                        'borderColor' => [
                            '#ee5b5b',
                            '#fcd53b',
                            '#0bdbb8',
                            '#464dee',
                        ],
                        'label' => 'Meeting Facilities'
                        ]
                        ],
        'labels' => $facilitiesData->pluck('label')->toArray()
        ];

        $room = Room::all()->count();
        $fas = Facilities::all()->count();
        $people = User::all()->count();

        $waiting = Meeting::where('status','Menunggu Pengajuan')->count();
        $schedule = Meeting::where('status','Menunggu Dimulai')->count();
        $ends = Meeting::where('status','Selesai')->count();


        $loggedInUserId = Auth::id();
        $countNoConclusion = Summary::where('user_id', $loggedInUserId)
                                    ->whereNull('summary_result')
                                    ->count();

        // Menghitung jumlah summaries yang sudah memiliki kesimpulan namun masih status private
        $countPrivate = Summary::where('user_id', $loggedInUserId)
                            ->where('status', '<>', 'PUBLIC')
                            ->whereNotNull('summary_result')
                            ->count();

        // Menghitung jumlah summaries yang memiliki status public
        $countPublic = Summary::where('user_id', $loggedInUserId)
                            ->where('status', 'PUBLIC')
                            ->count();

        // dd($facility);
        $userId = Auth::id();
        $meetingsInDay = Meeting::where('start_time', '>=', now()->startOfDay())

                                ->where('start_time', '<', now()->addDay()->startOfDay())
                                ->whereHas('participant', function ($query) use ($userId) {
                                    $query->where('user_id', $userId);
                                })->count();

        $meetingsAllDay = Meeting::whereHas('participant', function ($query) use ($userId) {
                                    $query->where('user_id', $userId)
                                    ->where('status', 'Selesai');
                                      })
                                      ->count();

        //  dd($mostUsedFacilities);
        return view('dashboard',compact(
                                            'events',
                                            'chartData',
                                            'meetingChartData',
                                            'facility',
                                            'room',
                                            'fas',
                                            'people',
                                            'waiting',
                                            'schedule',
                                            'ends',
                                            'countNoConclusion',
                                            'countPrivate',
                                            'countPublic',
                                            'meetingsInDay',
                                            'meetingsAllDay'
                                         ));
    }



    // public function roomUsageStatistics()
    // {
    //     // Query untuk mengambil 4 ruangan terpopuler
    //     $roomStatistics = DB::table('meetings')
    //                         ->select('room_id', DB::raw('count(*) as meetings_count'))
    //                         ->groupBy('room_id')
    //                         ->orderByDesc('meetings_count')
    //                         ->limit(4) // Ambil hanya 4 ruangan teratas
    //                         ->get();

    //     // Data untuk Chart.js
    //     $labels = [];
    //     $data = [];
    //     $backgroundColor = ['#007bff', '#6c757d', '#17a2b8', '#28a745']; // Warna yang tetap untuk setiap ruangan

    //     foreach ($roomStatistics as $stat) {
    //         // Contoh logika untuk mendapatkan nama ruangan atau detail lainnya
    //         $roomName = 'Room ' . $stat->room_id; // Misalnya: Ambil nama ruangan dari tabel lain jika ada
    //         $labels[] = $roomName;
    //         $data[] = $stat->meetings_count;
    //     }

    //     // Data untuk Chart.js
    //     $chartData = [
    //         'labels' => $labels,
    //         'datasets' => [
    //             [
    //                 'data' => $data,
    //                 'backgroundColor' => $backgroundColor,
    //                 'borderColor' => $backgroundColor,
    //             ]
    //         ]
    //     ];

    //     dd($chartData);
    //     // Kirim data ke view 'room_usage_statistics'
    //     return view('dashboard', compact('chartData'));
    // }


    // public function getNotifications()
    // {
    //     $user = Auth::user();
    //     $notifications = $user->unreadNotifications;
    //     return view('partials.notifications', compact('notifications'));
    // }


//     public function getLatestMeetings()
// {
//     $user = Auth::user();

//         // Jika bukan admin, ambil rapat yang diikuti oleh pengguna
//     $meetingsss = Meeting::whereHas('participant', function ($query) use ($user) {
//             $query->where('user_id', $user->user_id)
//             ->where('status', 'Menunggu Dimulai');
//         })->orderBy('start_time', 'desc')->take(4)->get();

//     // dd($meeting);

//     return view('layouts.index', compact('meetingsss'));
// }
}

