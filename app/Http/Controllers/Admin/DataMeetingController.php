<?php
namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class DataMeetingController extends Controller
{
    public function meetingresult(Request $request)
    {
        if ($request->ajax()) {
            $meetings = Meeting::with(['leader', 'minutes', 'rooms', 'summaries'])
                ->where('status', 'Selesai')
                ->select([
                    'meetings.*',
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
                ->addColumn('summary', function ($mt) {
                    $summaryResult = $mt->summaries->filter(function ($summary) {
                        return $summary->status !== 'PRIVATE';
                    })->pluck('summary_result')->implode(', ');
                    
                    return $summaryResult ?: 'Menunggu Hasil Dipublish';
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
                ->filterColumn('time_range', function ($query, $keyword) {
                    $query->whereRaw("CONCAT(DATE_FORMAT(start_time, '%d-%m-%Y %H:%i'), ' - ', DATE_FORMAT(end_time, '%H:%i')) like ?", ["%{$keyword}%"]);
                })
                ->rawColumns(['action', 'status', 'start_time'])
                ->make(true);
        }

        return view('admin.data-hasil-rapat');
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

        return view('admin.detail-hasil', compact('meeting', 'summaryResult'));
    }
}
