<?php

namespace App\Http\Controllers\Admin;

use App\Models\Room;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       ;
        if ($request->ajax()) {
            $rooms  = Room::All();
            return DataTables::of($rooms)
                ->addColumn('action', function ($rooms) {
                    return '
                        <a href="' . route('rooms.edit', $rooms->room_id) . '" class="btn btn-warning m-2"><i class="mdi mdi-pencil-box-outline"></i> Edit</a>
                        <form id="delete-form-'.$rooms->room_id.'" action="' . route('rooms.destroy', $rooms->room_id) . '" method="POST" class="d-inline">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="button" class="btn btn-dark delete-button" data-id="'. $rooms->room_id .'"><i class="mdi mdi-delete-forever"></i> Delete</button>
                        </form>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.ruang-rapat');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.add-ruang');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_name' => 'required|string|max:255|unique:rooms,room_name',
            'capacity'  => 'required|numeric'
        ]);
        $data= [
            'room_name' => $request->room_name,
            'capacity'  => $request->capacity
        ];

        Room::create($data);
        Alert::toast('Data has been saved successfully', 'success');
        return redirect()->route('rooms.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        //

        return view('admin.edit-ruang', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        //

        $request->validate([
            'room_name' => 'required|string|max:255|unique:rooms,room_name,'.$room->room_id.',room_id',
            'capacity'  => 'required|numeric'
        ]);
        $data= [
            'room_name' => $request->room_name,
            'capacity'  => $request->capacity
        ];

        $room->update($data);
        Alert::toast('Data has been upadate successfully', 'success');
        return redirect()->route('rooms.index');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $room = Room::findOrFail($id);

    // Check if the room is associated with any meeting
    if ($room->meetings()->exists()) {
        // If the room is associated with any meeting, show an error message and redirect back
        Alert::toast('Cannot delete the room because it is associated with one or more meetings.', 'error');
        return redirect()->back();
    }

    // If the room is not associated with any meeting, proceed with deletion
    $room->delete();

    // Redirect back with success message
    Alert::toast('Data has been delete successfully', 'success');
    return redirect()->route('rooms.index');
    }
}
