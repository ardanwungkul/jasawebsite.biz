<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

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
    public function update(Request $request, User $user)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
            ]
        );
        $file_path = public_path('storage/images/fotoProfil/' . $user->image);
        if ($request->hasFile('image')) {
            if ($user->image !== 'default_image.jpg' && $user->image !== null) {
                unlink($file_path);
            }
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $nama_file = date('YmdHi') . $file->getClientOriginalName();
            $file->move('storage/images/fotoProfil', $nama_file);
            $user->image = $nama_file;
        }
        $user->fill($request->post())->save();
        return Redirect::back()->with('status', 'profile-updated');
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
