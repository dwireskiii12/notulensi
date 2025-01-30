<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        // dd($request);
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->user_id, 'user_id'),
            ],
            'phone_number' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'faculty' => 'nullable|string|max:255',
            'study_program' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position,
            'phone_number' => $request->phone_number,
            'faculty' => $request->faculty,
            'study_program' => $request->study_program,
        ];

        // if ($request->hasFile('image')) {
        //     // Delete the previous image if it exists
        //     if ($user->image) {
        //         Storage::disk('public')->delete('img/' . $user->image);
        //     }

        //     $image = $request->file('image');
        //     $profileImage = time() . '.' . $image->getClientOriginalExtension();
        //     $image->storeAs('img', $profileImage, 'public');
        //     $data['image'] = $profileImage;


        // }

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

        $user->update($data);
        // $user->update($request->only('name', 'email', 'phone_number', 'position', 'faculty', 'study_program', 'image'));

        // $request->user()->fill($request->validated());

        // if ($request->user()->isDirty('email')) {
        //     $request->user()->email_verified_at = null;

        // }

        // $request->user()->save();
        Alert::toast('profile-updated successfully.', 'success');

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
