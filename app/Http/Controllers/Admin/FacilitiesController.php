<?php

namespace App\Http\Controllers\Admin;

use App\Models\Facilities;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class FacilitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // $fasili  = Facilities::All();
    // return view('admin.fasilitas-rapat',compact('fasili'));
    // //
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Facilities::all();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    return '
                        <a  href="' . route('fas.edit', $data->facilities_id) . '" class="btn btn-warning m-2"><i class="mdi mdi-pencil-box-outline"></i> Edit</a>
                        <form id="delete-form-'.$data->facilities_id.'" action="' . route('fas.destroy', $data->facilities_id) . '" method="POST" class="d-inline">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="button" class="btn btn-dark delete-button" data-id="'. $data->facilities_id .'"><i class="mdi mdi-delete-forever"></i> Delete</button>
                        </form>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.fasilitas-rapat');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.add-fasilitas');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'facilities' => 'required|string|max:100|unique:facilities,facilities',
        ]);
        $data= [
            'facilities' => $request->facilities,
        ];

        Facilities::create($data);
        Alert::toast('Data has been saved successfully', 'success');
        return redirect()->route('fas.index');
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
    public function edit($id)
    {
        //
        $fas = Facilities::findOrFail($id);
        return view('admin.edit-fasilitas', compact('fas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            'facilities' => 'required|unique:facilities,facilities,'. $id .',facilities_id',
        ]);
        $data= [
            'facilities' => $request->facilities,
        ];
        Facilities::where('facilities_id', $id)->update($data);
        Alert::toast('Data has been update successfully', 'success');

        return redirect()->route('fas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Facilities::findOrFail($id);
        $data->delete();
        Alert::toast('Data has been deleted successfully', 'success');
        return redirect()->route('fas.index');
    }
}
