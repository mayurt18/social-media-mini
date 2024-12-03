<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;


class ProfileController extends Controller
{
    public function update(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'bio' => 'nullable|string|max:500',
        'profile_picture' => 'nullable|file|mimes:jpg,png|max:10240',
    ]);

    $user = auth()->user();
    $user->name = $request->name;
    $user->bio = $request->bio;

    if ($request->hasFile('profile_picture')) {
        $filePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        $user->profile_picture = $filePath;
    }

    $user->save();

    return redirect()->route('profile.show', $user->id)->with('success', 'Profile updated successfully.');
}
public function show($id)
    {
        // Fetch the user by ID
        $user = User::findOrFail($id);

        // Return the profile view with user data
        return view('profile.show', compact('user'));
    }
    public function edit()
    {
        // Fetch the authenticated user's data
        $user = Auth::user();

        // Return the edit profile view with user data
        return view('profile.edit', compact('user'));
    }

}
