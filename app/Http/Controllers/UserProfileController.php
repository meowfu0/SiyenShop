<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;


class UserProfileController extends Controller
{
    public function showProfile()
    {
        // Retrieve the currently authenticated user
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login'); // Redirect to login if user is not authenticated
        }

        // Pass the $user variable to the view
        return view('components.profile', compact('user'));
    }
    // Handle the profile update
    public function edit()
    {
        // Retrieve the authenticated user
        $user = Auth::user();
    
        // If there's no authenticated user, redirect them to the login page
        if (!$user) {
            return redirect()->route('login');
        }
    
        // Pass the $user variable to the view
        return view('components.edit', compact('user'));
    }
  public function update(Request $request, User $user)
{
    // Validate the incoming request
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'phone_number' => 'nullable|string|max:20',
        'course' => 'required|string',
        'year' => 'required|string',
        'block' => 'required|string',
        'password' => 'nullable|string|min:6|confirmed',
    ]);

    // Ensure that the user object is correct
    dd($user); // Debugging: Check if the correct user object is passed

    // Manually update the user data
    $user->first_name = $validated['first_name'];
    $user->last_name = $validated['last_name'];
    $user->email = $validated['email'];
    $user->phone_number = $validated['phone_number'];
    $user->course = $validated['course'];
    $user->year = $validated['year'];
    $user->block = $validated['block'];

    // Only update password if it's provided
    if ($validated['password']) {
        $user->password = bcrypt($validated['password']);
    }

    // Save the user record
    if ($user->save()) {
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully');
    } else {
        return redirect()->route('profile.edit')->with('error', 'Failed to update profile');
    }
}
}
