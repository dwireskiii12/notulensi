<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        // $user = User::all();
        // return view('admin.data-pengguna', compact('user'));

        if ($request->ajax()) {
            $users = User::All();
            foreach ($users as $user) {
                switch ($user->role) {
                    case 1:
                        $user->role_name = 'Admin';
                        break;
                    case 2:
                        $user->role_name = 'Sekertaris';
                        break;
                    case 3:
                        $user->role_name = 'Notulensi';
                        break;
                    case 4:
                        $user->role_name = 'User';
                        break;
                    default:
                        $user->role_name = 'Unknown';
                }
            }
            return DataTables::of($users)
                ->addColumn('action', function ($users) {
                    return '
                        <a href="' . route('users.edit', $users->user_id) . '" class="btn btn-warning m-2"><i class="mdi mdi-pencil-box-outline"></i> Edit</a>
                        <form id="delete-form-'.$users->user_id .'" action="' . route('users.destroy', $users->user_id) . '" method="POST" class="d-inline">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="button" class="btn btn-dark delete-button" data-id="'. $users->user_id .'"><i class="mdi mdi-delete-forever"></i> Delete</button>
                        </form>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
    }
    return view('admin.data-pengguna');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.add-pengguna');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request);
        $request->validate([
            'name' => 'required',
            'email'  => 'required|email|unique:users,email',
            'password'  => 'required|min:8',
            'position'  => 'required',
            'phone_number'  => 'required|numeric',
            'faculty'  => 'required',
            'study_program'  => 'required',
            'role'  => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data= [
            'name' => $request->name,
            'email'  => $request->email,
            'password' => Hash::make($request->password),
            'position' => $request->position,
            'phone_number' => $request->phone_number,
            'faculty' => $request->faculty,
            'study_program' => $request->study_program,
            'role' => $request->role,


        ];
        if ($image = $request->file('image')) {
            $destinationPath = 'img/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['image'] = "$profileImage";
        }
        // dd($data);

        User::create($data);
        Alert::toast('Data has been saved successfully', 'success');
        return redirect()->route('users.index');
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

        $user = User::findOrFail($id);
        return view('admin.edit-pengguna', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'position' => 'required',
            'phone_number' => 'required|numeric',
            'faculty' => 'required',
            'study_program' => 'required',
            'role' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::findOrFail($id);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position,
            'phone_number' => $request->phone_number,
            'faculty' => $request->faculty,
            'study_program' => $request->study_program,
            'role' => $request->role
        ];

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|min:8',
            ]);

            $data['password'] = Hash::make($request->password);
        }
        if ($image = $request->file('image')) {
            // Delete the previous image if it exists
            if ($user->image) {
                $previousImagePath = public_path('img/' . $user->image);
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }

            $destinationPath = 'img/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['image'] = $profileImage;
        }
        // dd($user);

        $user->update($data);
        Alert::toast('Data has been update successfully', 'success');

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function hasRelatedMeetings()
{
    return $this->meetings()->exists();
}

public function destroy($id)
{
    DB::beginTransaction();
    try {
        $user = User::findOrFail($id);

        if ($user->hasRelatedMeetings()) {
            Alert::toast('Tidak dapat menghapus pengguna karena ada rapat terkait.', 'error');
            return redirect()->back();
        }

        if ($user->image) {
            // Delete the image file from storage
            $imagePath = public_path('img/' . $user->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $user->delete();

        DB::commit();
        Alert::toast('Data has been delete successfully', 'success');
        return redirect()->route('users.index');
    } catch (QueryException $e) {
        DB::rollBack();
        Log::error('Kesalahan SQL saat menghapus pengguna: ' . $e->getMessage());
        Alert::toast('Terdapat kesalahan dalam menghapus pengguna. Silakan coba lagi.', 'error');
        return redirect()->back();
    } catch (Exception $e) {
        DB::rollBack();
        Log::error('Kesalahan umum saat menghapus pengguna: ' . $e->getMessage());
        Alert::toast('Terdapat kesalahan dalam menghapus pengguna. Silakan coba lagi.', 'error');
        return redirect()->back();
    }
}
}
