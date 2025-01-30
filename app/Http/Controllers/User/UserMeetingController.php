<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Meeting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserMeetingController extends Controller
{
    //

    public function index(Request $request){
        $activeTab = $request->get('tab', 'one');
        $userId = Auth::id();

        $query = Meeting::query();

        // Filter berdasarkan judul
        if ($request->filled('title')) {
            $query->where('meeting_theme', 'like', '%' . $request->input('title') . '%');
        }

        // Filter berdasarkan tanggal
        if ($request->filled('date')) {
            $query->whereDate('start_time', '=', $request->input('date'));
        }

        // Filter berdasarkan pemimpin rapat
        if ($request->filled('leader')) {
            $query->whereHas('leader', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('leader') . '%');
            });
        }
        // Ambil data rapat untuk tab "Meeting In Day" (rentang waktu 1 hari)
        $meetingsInDay = Meeting::where('start_time', '>=', now()->startOfDay())
                                ->where('status', 'Menunggu Dimulai')
                                ->orwhere('status', 'Rapat Dimulai')
                                ->where('start_time', '<', now()->addDay()->startOfDay())
                                ->whereHas('participant', function ($query) use ($userId) {
                                    $query->where('user_id', $userId);
                                })
                                ->get();
        // dd($meetingsInDay);

       $usersId = Auth::id();

       $meetingsAllDay = Meeting::whereHas('participant', function ($query) use ($usersId) {
                                 $query->where('user_id', $usersId)
                                 ->where('status', 'Menunggu Dimulai')
                                 ->orwhere('status', 'Rapat Dimulai');
                                   })
                                   ->get();

        return view('users.agenda-rapat', compact('meetingsAllDay', 'meetingsInDay','activeTab'));



        // $idProdi = 1;

        // $meeting = Meeting::whereHas('fakultas.dosen.prodi', function ($query) use ($idProdi) {
        //     $query->where('id', $idProdi);
        // })->get();

    }


    public function resultusermeeting(Request $request)
    {
        $userId = Auth::id();
        $query = Meeting::whereHas('participant', function ($query) use ($userId) {
            $query->where('user_id', $userId)
                ->where('status', 'Selesai');

              });
                  // Apply search filters
            if ($request->filled('title')) {
                $query->where('meeting_theme', 'like', '%' . $request->title . '%');
            }

            if ($request->filled('date')) {
                $query->whereDate('start_time', $request->date);
            }

            if ($request->filled('leader')) {
                $query->whereHas('leader', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->leader . '%');
                });
            }

            $meetingsAllDay = $query->paginate(5);

         return view('users.riwayat-rapat', compact('meetingsAllDay'));

     }



     public function detailscheduleuser($id)
     {

        $userId = auth()->id(); // Mendapatkan ID pengguna yang sedang login

        // Menemukan rapat berdasarkan ID dengan peserta yang mencakup pengguna yang sedang login
        $meeting = Meeting::with(['leader', 'minutes', 'rooms', 'summaries', 'participant' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }])->findOrFail($id);

        // Mengecek apakah pengguna terdaftar sebagai peserta
        $isParticipant = $meeting->participant->where('user_id', $userId)->isNotEmpty();

        if (!$isParticipant) {
            abort(403, 'You are not authorized to view this meeting details.');
        }


         return view('users.detail-jadwal', compact('meeting'));
     }

    public function detailuserresult($id)
    {
        $userId = auth()->id(); // Mendapatkan ID pengguna yang sedang login

        // Menemukan rapat berdasarkan ID dengan peserta yang mencakup pengguna yang sedang login
        $meeting = Meeting::with(['leader', 'minutes', 'rooms', 'summaries', 'participant' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }])->findOrFail($id);

        // Mengecek apakah pengguna terdaftar sebagai peserta
        $isParticipant = $meeting->participant->where('user_id', $userId)->isNotEmpty();

        if (!$isParticipant) {
            abort(403, 'You are not authorized to view this meeting details.');
        }

        $summaryResult = $meeting->summaries->filter(function ($summary) {
            return $summary->status !== 'PRIVATE';
        })->pluck('summary_result')->implode(', ');

        if ($summaryResult === '') {
            $summaryResult = 'Menunggu Hasil Dipublish';
        }
    // $summaryResult = $meeting->summaries->isNotEmpty() ? $meeting->summaries->pluck('summary_result')->implode(', ') : 'No Summary';

    return view('users.detail-rapat-user', compact('meeting', 'summaryResult'));
}
}
