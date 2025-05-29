<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $doctor = Auth::user();
        return view('doctor.profile.show', compact('doctor'));
    }

    public function edit()
    {
        $doctor = Auth::user();
        return view('doctor.profile.edit', compact('doctor'));
    }

    public function update(Request $request)
    {
        $doctor = Auth::user();

        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $doctor->id,
            'phone' => 'nullable|string|max:20',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'nullable|confirmed|min:8',
        ]);

        // Update fields
        $doctor->firstname = $request->firstname;
        $doctor->lastname = $request->lastname;
        $doctor->email = $request->email;
        $doctor->phone = $request->phone;

        if ($request->filled('password')) {
            $doctor->password = Hash::make($request->password);
        }

        // Handle profile picture
        if ($request->hasFile('profile_picture')) {
            // Delete old picture
            if ($doctor->profile_picture && Storage::exists($doctor->profile_picture)) {
                Storage::delete($doctor->profile_picture);
            }
            $path = $request->file('profile_picture')->store('public/profile_pictures');
            $doctor->profile_picture = $path;
        }

        $doctor->save();

        return redirect()->route('doctor.profile.show')->with('success', 'Profile updated successfully.');
    }

    public function destroy()
    {
        $doctor = Auth::user();
        Auth::logout();

        if ($doctor->profile_picture && Storage::exists($doctor->profile_picture)) {
            Storage::delete($doctor->profile_picture);
        }

        $doctor->delete();

        return redirect('/')->with('success', 'Account deleted successfully.');
    }
}
