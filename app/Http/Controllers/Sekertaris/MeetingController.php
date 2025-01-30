<?php

namespace App\Http\Controllers\Sekertaris;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\User;
use App\Models\Meeting;
use App\Models\Summary;
use App\Models\Facilities;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MeetingFacility;
use Yajra\DataTables\DataTables;
use App\Mail\NotulensiAccountMail;
use App\Models\MeetingParticipant;
use Illuminate\Support\Facades\DB;
use App\Mail\MeetingInvitationMail;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Notifications\MeetingNotification;

class MeetingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
   
            $meetings = Meeting::with(['leader', 'secretary', 'minutes', 'rooms'])
            ->whereIn('status', ['Menunggu Pengajuan'])
        
        ->select([
            'meetings.*',
            DB::raw("CONCAT(DATE_FORMAT(start_time, '%d-%m-%Y %H:%i'), ' - ', DATE_FORMAT(end_time, '%H:%i')) as time_range")
        ]);
            return DataTables::of($meetings)

                ->addColumn('action', function ($mt) {
                    if ($mt->status == 'Menunggu Dimulai') {
                        return '
                            <a href="' . route('meeting.show', $mt->meeting_id) . '" class="btn btn-info"></a>
                        ';
                    } else {
                        return '
                            <form id="delete-form-'.$mt->meeting_id.'" action="' . route('meeting.destroy', $mt->meeting_id) . '" method="POST" class="d-inline">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="button" class="btn btn-inverse-danger btn-sm cancel-button" data-id="'. $mt->meeting_id .'"><i class="mdi mdi-delete-forever"></i>   Cancel</button>
                            </form>
                            <a href="' . route('meeting.edit', $mt->meeting_id) . '" class="btn btn-inverse-warning btn-sm m-2"><i class="mdi mdi-pencil-box-outline"></i> Edit  </a>
                            <a href="' . route('meeting.preview', $mt->meeting_id) . '" class="btn btn-inverse-primary btn-sm"><i class="mdi mdi-contact-mail "></i> Submit </a>
                        ';
                    }
                })
                ->addColumn('minutes', function ($mt) {
                    return $mt->minutes ? $mt->minutes->name : 'Minutes Not Found';
                })
                ->addColumn('leader', function ($mt) {
                    return $mt->leader ? $mt->leader->name : 'Leader Not Found';
                })
                ->addColumn('rooms', function ($mt) {
                    return $mt->rooms ? $mt->rooms->room_name : 'Room Not Found';
                })
                ->editColumn('status', function ($mt) {
                    return '<span class="badge badge-danger">' . $mt->status . '</span>';
                })
                ->addColumn('start_time', function ($mt) {
                    return Carbon::parse($mt->start_time)->locale('id')->translatedFormat('l, d F Y');
                })
                // ->addColumn('jam_masuk', function ($mt) {
                
                ->editColumn('time_range', function ($mt) {
                    return Carbon::parse($mt->start_time)->format('H:i') . ' - ' . Carbon::parse($mt->end_time)->format('H:i');
                })
                ->filterColumn('time_range', function($query, $keyword) {
                    $query->whereRaw("CONCAT(DATE_FORMAT(start_time, '%d-%m-%Y %H:%i'), ' - ', DATE_FORMAT(end_time, '%H:%i')) like ?", ["%{$keyword}%"]);
                })

                ->rawColumns(['action', 'status','start_time', 'end_time','jam_masuk'])
                ->make(true);
        }

        return view('sekertaris.meeting');
    }



    public function schedule(Request $request)
    {
        if ($request->ajax()) {
            $meetings = Meeting::with(['leader', 'secretary', 'minutes', 'rooms'])
            ->whereIn('status', ['Menunggu Dimulai','Rapat Dimulai'])
            ->select(['meetings.*',
            DB::raw("CONCAT(DATE_FORMAT(start_time, '%d-%m-%Y %H:%i'), ' - ', DATE_FORMAT(end_time, '%H:%i')) as time_range")
        ]);
            return DataTables::of($meetings)
                ->addColumn('action', function ($mt) {
                        return '
                            <a href="' . route('meeting.show', $mt->meeting_id) . '" class="btn btn-info">Detail</a>
                        ';
                })
                ->addColumn('minutes', function ($mt) {
                    return $mt->minutes ? $mt->minutes->name : 'Minutes Not Found';
                })
                ->addColumn('leader', function ($mt) {
                    return $mt->leader ? $mt->leader->name : 'Leader Not Found';
                })
                ->addColumn('rooms', function ($mt) {
                    return $mt->rooms ? $mt->rooms->room_name : 'Room Not Found';
                })
                ->editColumn('status', function ($mt) {
                    return '<span class="badge badge-primary">' . $mt->status . '</span>';
                })
                ->addColumn('start_time', function ($mt) {
                    return Carbon::parse($mt->start_time)->locale('id')->translatedFormat('l, d F Y');
                })
                ->editColumn('time_range', function ($mt) {
                    return Carbon::parse($mt->start_time)->format('H:i') . ' - ' . Carbon::parse($mt->end_time)->format('H:i');
                })
                ->filterColumn('time_range', function($query, $keyword) {
                    $query->whereRaw("CONCAT(DATE_FORMAT(start_time, '%d-%m-%Y %H:%i'), ' - ', DATE_FORMAT(end_time, '%H:%i')) like ?", ["%{$keyword}%"]);
                })
                
                ->rawColumns(['action', 'status', 'start_time'])
                ->make(true);
        }

        return view('sekertaris.jadwal-rapat');
    }




    public function meetingresult(Request $request)
    {
        if ($request->ajax()) {
            $meetings = Meeting::with(['leader', 'minutes', 'rooms'])
                ->where('status', 'Selesai')
                ->select(['meetings.*',
                DB::raw("CONCAT(DATE_FORMAT(start_time, '%d-%m-%Y %H:%i'), ' - ', DATE_FORMAT(end_time, '%H:%i')) as time_range")
            ]);

            return DataTables::of($meetings)
                ->addColumn('action', function ($mt) {
                    return '<a href="' . route('meeting.detailresult', $mt->meeting_id) . '" class="btn btn-info">Detail</a>';
                })
                ->addColumn('minutes', function ($mt) {
                    return $mt->minutes ? $mt->minutes->name : 'Minutes Not Found';
                })
                ->addColumn('leader', function ($mt) {
                    return $mt->leader ? $mt->leader->name : 'Leader Not Found';
                })
                ->addColumn('rooms', function ($mt) {
                    return $mt->rooms ? $mt->rooms->room_name : 'Room Not Found';
                })
                ->editColumn('status', function ($mt) {
                    return '<span class="badge badge-primary">' . $mt->status . '</span>';
                })
                ->addColumn('start_time', function ($mt) {
                    return Carbon::parse($mt->start_time)->locale('id')->translatedFormat('l, d F Y');
                })
                ->editColumn('time_range', function ($mt) {
                    return Carbon::parse($mt->start_time)->format('H:i') . ' - ' . Carbon::parse($mt->end_time)->format('H:i');
                })
                ->filterColumn('time_range', function($query, $keyword) {
                    $query->whereRaw("CONCAT(DATE_FORMAT(start_time, '%d-%m-%Y %H:%i'), ' - ', DATE_FORMAT(end_time, '%H:%i')) like ?", ["%{$keyword}%"]);
                })
                ->rawColumns(['action', 'status','start_time'])
                ->make(true);
        }

        return view('sekertaris.hasil-rapat');
    }


    public function create()
    {
        $roles = [1, 2, 4];
        // $users = User::all();
        $users = User::whereIn('role', $roles)->get();
        $room = Room::all();
        $facilities = Facilities::all();

        return view('sekertaris.form-rapat',
                     compact(
                              'users',
                              'room',
                              'facilities'
        ));
    }




    public function preview($id)
    {
        $meeting = Meeting::with('participants', 'minutes', 'leader', 'rooms')->findOrFail($id);
        return view('sekertaris.preview', compact('meeting'));
    }



    public function sendInvitation(Request $request, $id)
    {
        $meeting = Meeting::with('participants', 'minutes', 'leader', 'rooms')->findOrFail($id);

        // Validasi tanggal
        if (now()->greaterThanOrEqualTo($meeting->start_time)) {
            Alert::toast('The meeting date has passed or is currently ongoing.', 'error');
            return redirect()->back();
        }

        $minutesUser = User::find($meeting->meeting_minutes);
        if ($minutesUser) {
            // Cek apakah akun notulensi sudah ada berdasarkan original_user_id
            $notulensiUser = User::where('original_user_id', $minutesUser->user_id)->first();

            if (!$notulensiUser) {
                // Buat akun notulensi baru jika belum ada
                $password = Str::random(12); // Buat password baru secara acak
                $hashedPassword = Hash::make($password); // Hash password baru

                $notulensiUser = User::create([
                    'name' => $minutesUser->name,
                    'email' => 'notulensi_' . $minutesUser->email,
                    'password' => $hashedPassword,
                    'role' => 3,
                    'original_user_id' => $minutesUser->user_id,
                ]);
            } else {
                // Jika akun notulensi sudah ada, buat password baru
                $password = Str::random(12); // Buat password baru secara acak
                $hashedPassword = Hash::make($password); // Hash password baru

                // Perbarui password di database
                $notulensiUser->password = $hashedPassword;
                $notulensiUser->save();
            }

            // Kirim email akun notulensi, baik itu akun baru atau yang sudah ada
            Mail::to($minutesUser->email)->queue(new NotulensiAccountMail(
                $notulensiUser->name,
                $notulensiUser->email,
                $password, // Menggunakan password yang sudah ada atau yang baru dibuat
                $meeting
            ));
            // Buat record summary
            Summary::create([
                'meeting_id' => $meeting->meeting_id,
                'user_id' => $notulensiUser->user_id,
            ]);
        }

        $meeting->status = 'Menunggu Dimulai';
        $meeting->save();

        // Mengirim email ke setiap peserta
        $participants = $meeting->participants;
        foreach ($participants as $participant) {
            Mail::to($participant->email)->queue(new MeetingInvitationMail($meeting, $participant));
            // $participant->notify(new MeetingNotification($meeting));
        }



        Alert::toast('The meeting invitation has been successfully sent.', 'success');
        return redirect()->route('meeting.index');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
      $request->validate([
        'meeting_theme' => 'required|string|max:255',
        'meeting_minutes' => 'required',
        'meeting_leader' => 'required',
        'room_id' => 'required',
        'description' => 'nullable|string',
        'start_time' => 'required|date',
        'end_time' => 'required|date|after:start_time',
        'participant_count' => 'required|integer|min:1',
        'user_id' => 'required|array|min:1',
        'facilities' => 'required|array',

    ]);



    $room = Room::find($request->room_id);
    if ($room) {
        if ($request->participant_count > $room->capacity) {
            Alert::toast('The number of participants exceeds the rooms capacity.', 'error');
            return redirect()->back();
        }

    } else {
        Alert::toast('Rooms not valid.', 'error');
        return redirect()->back();
    }

    $participantCount = count($request->user_id);
    if ($participantCount > $request->participant_count) {
        Alert::toast('The number of participants exceeds the rooms capacity.', 'error');
        return redirect()->back();
    }


    // Periksa ketersediaan ruangan dan waktu
    $isAvailable = $this->checkRoomAndTimeAvailability($request->room_id, $request->start_time, $request->end_time);
    if (!$isAvailable) {
        Alert::toast('Im sorry, the room or time requested has already been taken.', 'error');
        return redirect()->back();
    }

    // Simpan data rapat
    $meeting = new Meeting();
    $meeting->auth_id = Auth::id();//////////////////////////////////////////////////////////tandai
    $meeting->meeting_theme = $request->meeting_theme;
    $meeting->meeting_minutes = $request->meeting_minutes;
    $meeting->meeting_leader = $request->meeting_leader;
    $meeting->description = $request->description;
    $meeting->start_time = $request->start_time;
    $meeting->end_time = $request->end_time;
    $meeting->participant_count = $request->participant_count;
    $meeting->room_id = $request->room_id;
    $meeting->save();

    $meetingId = $meeting->meeting_id;


    // Simpan peserta rapat
    if ($request->has('user_id')) {
        foreach ($request->user_id as $user_id) {
            MeetingParticipant::create([
                'meeting_id' => $meetingId,
                'user_id' => $user_id
            ]);
        }
    }
    // Simpan fasilitas rapat
    if ($request->has('facilities')) {
        foreach ($request->facilities as $facility) {
            MeetingFacility::create([
                'meeting_id' => $meetingId,
                'facilities_name' => $facility
            ]);
        }
    }
    // Redirect atau respons sesuai kebutuhan
    Alert::toast('The meeting has been successfully proposed/submitted.', 'success');
    return redirect()->route('meeting.index');
    }

    private function checkRoomAndTimeAvailability($roomId, $startTime, $endTime, $editingMeetingId= null)
    {
       // Periksa apakah ada rapat lain di ruangan yang sama pada waktu yang diminta
        $isRoomAvailable = !Meeting::where('room_id', $roomId)
        ->where(function ($query) use ($startTime, $endTime, $editingMeetingId) {
            $query->where(function ($query) use ($startTime, $endTime) {
                    $query->whereBetween('start_time', [$startTime, $endTime])
                            ->orWhereBetween('end_time', [$startTime, $endTime])
                            ->orWhere(function ($query) use ($startTime, $endTime) {
                                $query->where('start_time', '<=', $startTime)
                                    ->where('end_time', '>=', $endTime);
                            });
                })
                ->when($editingMeetingId, function ($query) use ($editingMeetingId) {
                    $query->where('id', '!=', $editingMeetingId);
                });
        })->exists();

        return $isRoomAvailable;

        // Periksa apakah ada rapat lain pada waktu yang diminta di semua ruangan
        $isTimeAvailable = !Meeting::where(function ($query) use ($startTime, $endTime) {
                                    $query->whereBetween('start_time', [$startTime, $endTime])
                                          ->orWhereBetween('end_time', [$startTime, $endTime])
                                          ->orWhere(function ($query) use ($startTime, $endTime) {
                                              $query->where('start_time', '<=', $startTime)
                                                    ->where('end_time', '>=', $endTime);
                                          });
                                })
                                ->exists();

        return $isRoomAvailable && $isTimeAvailable;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $room = Room::all();
        $meeting = Meeting::with('participants', 'minutes', 'leader', 'rooms', 'facilities')->findOrFail($id);
        return view('sekertaris.detail-rapat', compact('meeting', 'room'));
    }


    public function detailresult($id)
    {


        $meeting = Meeting::with(['leader', 'minutes', 'rooms', 'summaries'])->findOrFail($id);
        $summaryResult = $meeting->summaries->filter(function ($summary) {
            return $summary->status !== 'PRIVATE';
        })->pluck('summary_result')->implode(', ');

        if ($summaryResult === '') {
            $summaryResult = 'Menunggu Hasil Dipublish';
        }

        return view('sekertaris.detail-hasil', compact('meeting', 'summaryResult'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $room = Room::all();
        $meeting = Meeting::with('participants', 'minutes', 'leader', 'rooms', 'facilities')->findOrFail($id);
        return view('sekertaris.edit-jadwal', compact('meeting', 'room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // dd($request);
    $meeting = Meeting::findOrFail($id);

    $request->validate([
        'participant_count' => 'required|integer|min:1',
        'start_time' => 'required|date',
        'end_time' => 'required|date|after:start_time',
        'room_id' => 'required'
    ]);

    $room = Room::find($request->room_id);

    if ($request->participant_count > $room->capacity) {
        Alert::toast('The number of participants exceeds the rooms capacity.', 'error');
        return redirect()->back();
    }


    // Bandingkan data yang dikirimkan dengan data dalam database
    $isDataChanged = $meeting->start_time != $request->start_time ||
                    $meeting->end_time != $request->end_time ||
                    $meeting->room_id != $request->room_id;

    // Jika tidak ada perubahan pada data rapat, langsung redirect ke halaman index
    if (!$isDataChanged) {

        Alert::toast('No changes to the meeting data.', 'success');
        return redirect()->route('meeting.index');
    } else {
        // Periksa ketersediaan ruangan dan waktu hanya jika ada perubahan pada data rapat
        $isAvailable = $this->checkRoomAndTimeAvailability($request->room_id, $request->start_time, $request->end_time, $meeting->id);

        if (!$isAvailable) {
            Alert::toast('Im sorry, the room or time requested has already been taken.', 'error');
            return redirect()->back();
        }

        // Update hanya data yang berubah
        $meeting->fill($request->only(['start_time', 'end_time', 'room_id']));
        $meeting->save();




        // Redirect kembali ke halaman index
        Alert::toast('The meeting has been successfully updated.', 'success');
        return redirect()->route('meeting.index');
    }
}




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $meeting = Meeting::find($id);

        if (!$meeting) {
            Alert::toast('Dont Deleted for meeting, because meetings in schedule on', 'error');
            return redirect()->back();
        }
        $meeting->delete();
        Alert::toast('Data meeting has been cancel successfully', 'success');
        return redirect()->route('meeting.index');

    }




}
