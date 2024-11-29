<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\GCashInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; 


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

        $user_id = $user->id;

        if (!$user) {
            return redirect()->route('login'); // Redirect to login if user is not authenticated
        }

        $gcashInfos = GCashInfo::where('user_id', $user_id)->get();
    
        // Pass the $user variable to the view
        return view('components.edit', compact('user', 'gcashInfos'));
    }
 // Add this if not already included

public function update(Request $request, User $user)
{
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'phone_number' => 'nullable|string|max:20',
        'course_bloc' => 'required|string',
        'year' => 'required|string',
        'course_id' => 'required|integer|exists:courses,id',
        'password' => 'nullable|string|min:6|confirmed',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image
        
        
    ]);

    // Initialize a variable to track profile picture updates
    $updatedData = $validated;
    $profilePicturePath = null;

    // Check if the user uploaded a new profile picture
    if ($request->hasFile('profile_picture')) {
        $profile_picture = $request->file('profile_picture');
        $fileName = time() . '.' . $profile_picture->getClientOriginalExtension();
        $profile_picture->storeAs('public/profile_picture', $fileName);
        $profilePicturePath = 'profile_picture/' . $fileName;
        $user->profile_picture = $profilePicturePath;
        $updatedData['profile_picture'] = $profilePicturePath;
    }

    // Update other user details
    $user->first_name = $validated['first_name'];
    $user->last_name = $validated['last_name'];
    $user->email = $validated['email'];
    $user->phone_number = $validated['phone_number'] ?? $user->phone_number;
    $user->course_bloc = $validated['course_bloc'];
    $user->year = $validated['year'];
    $user->course_id = $validated['course_id'];
    $user->gcash_name = $validated['gcash_name'] ?? $user->gcash_name;
    $user->gcash_number = $validated['gcash_number'] ?? $user->gcash_number;
    $user->gcash_limit = $validated['gcash_limit'] ?? $user->gcash_limit;


    


     // Hash and update password if provided
     if (!empty($validated['password'])) {
        $user->password = bcrypt($validated['password']);
    }
    // Update password if it's provided
    if (!empty($validated['password'])) {
        $user->password = bcrypt($validated['password']);
    }

    // Save the updated user and log the changes
    if ($user->save()) {
        // Log profile update
        Log::info('Profile updated successfully.', [
            'user_id' => $user->id,
            'updated_data' => $updatedData,

            
        ]);

        return redirect()->route('profile', $user->id)->with('success', 'Profile updated successfully!');
    } else {
        return back()->with('error', 'Failed to update profile. Please try again.');
    }
}
}