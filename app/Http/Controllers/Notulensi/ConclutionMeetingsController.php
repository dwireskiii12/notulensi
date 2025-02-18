<?php

namespace App\Http\Controllers\Notulensi;

use Carbon\Carbon;
use App\Models\Summary;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\MeetingParticipant;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\MeetingSummaryPublished;
use RealRashid\SweetAlert\Facades\Alert;

class ConclutionMeetingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Periksa peran pengguna
        if ($user->role !== 3) {
            return redirect()->route('login')->with('error', 'Anda tidak memiliki akses.');
        }

        if ($request->ajax()) {
            $data = Summary::with(['meeting', 'meeting.leader', 'user'])
                           ->where('user_id', $user->user_id)
                           ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('meeting_id', function($row){
                    return $row->meeting->meeting_id ?? 'N/A';
                })
                ->addColumn('meeting_theme', function($row){
                    return $row->meeting->meeting_theme ?? 'N/A';
                })
                ->addColumn('leader_name', function($row){
                    return $row->meeting->leader->name ?? 'N/A';
                })
                ->addColumn('start_time', function($row){
                    if($row->meeting) {

                        return Carbon::parse($row->meeting->start_time)->locale('id')->translatedFormat('l, d F Y');
                    }
                    return 'N/A';
                })
                // ->addColumn('end_time', function($row){
                //     return $row->meeting->end_time ?? 'N/A';
                // })
                ->addColumn('time_range', function($row){
                    if($row->meeting) {
                        return Carbon::parse($row->meeting->start_time)->format('H:i') . ' - ' . Carbon::parse($row->meeting->end_time)->format('H:i');
                    }
                    return 'N/A';
                })
                ->addColumn('summary_result', function($row){
                    return $row->summary_result ?? 'N/A';
                })
                ->addColumn('meeting_status', function($row){
                    return $row->meeting->status ?? 'N/A';
                })
                ->addColumn('status_badge', function($row){
                    $badgeClass = $row->status == 'PUBLIC' ? 'badge-primary' : 'badge-danger';
                    return '<span class="badge '.$badgeClass.'">'.$row->status.'</span>';
                })
                ->addColumn('action', function($row){
                    $btn = '';
                    if ($row->status !== 'PUBLIC') {
                        if (empty($row->summary_result)) {
                            $btn .= '<a href="'.route('conclution-meetings.edit', $row->summary_id).'" class="btn btn-inverse-primary btn-sm m-2">Input Kesimpulan</a>';
                        } else {
                            $btn .= '<a href="'.route('conclution-meetings.edit', $row->summary_id).'" class="btn btn-inverse-warning btn-sm m-2">Edit Kesimpulan</a>';
                        }
                    }
                    $btn .= '<a href="'.route('conclution-meetingss.show', $row->summary_id).'" class="btn btn-inverse-dark btn-sm">Detail</a>';
                    return $btn;
                })
                ->rawColumns(['status_badge','action'])
                ->make(true);
        }

        return view('notulensi.data-notulensi');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {



    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $summary = Summary::with(['meeting', 'user'])->findOrFail($id);

        // return view('emails.meeting_summary_published', compact('summary'));
        return view('notulensi.detail-notulensi', compact('summary'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //

        $summary = Summary::with(['meeting', 'user'])->findOrFail($id);

        // return view('emails.meeting_summary_published', compact('summary'));
        return view('notulensi.form-notulensi', compact('summary'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Summary $summary)
    {
        //
        $request->validate([
            'summary_result' => 'required|string',
        ]);
        $data= [
            'user_id'  => Auth::id(),
            'summary_result' => $request->summary_result,
        ];

        // Periksa tombol mana yang diklik
        if ($request->input('action') === 'save') {
            $data['status'] = 'PRIVATE';
            $summary->update($data);
            Alert::toast('The meeting summary has been published successfully.', 'success');
            // $message = '<strong>Success!</strong> The meeting summary has been updated private successfully.';
            // $message = '<strong>Error!</strong> Public summaries cannot be edited.';

        } elseif ($request->input('action') === 'publish') {
            $data['status'] = 'PUBLIC';
            $summary->update($data);
            // $this->sendEmailToParticipants($summary);
            Alert::toast('The meeting summary has been published successfully.', 'success');
            // $message = '<strong>Success!</strong> The meeting summary has been published successfully.';
        }

        return redirect()->route('conclution-meetings.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Summary $summary)
    {
        //
    }


}
