<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Course;
use App\Models\GCashInfo;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class CreateShopController extends Controller
{
    public function index()
    {
        // Retrieve managers and courses
        $managers = User::where('role_id', 2)->get();
        //$shops = Shop::with(['gcashInfo.user', 'course', 'status'])->get();
        $courses = Course::all();

        return view('livewire.admin.create-shop', compact('managers', 'courses'));
    }

    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'shop_name' => 'required|string|max:255',
            'shop_email' => 'required|email|unique:users,email', // Validate against the users table
            'course_id' => 'required|exists:courses,id',
            'shop_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            //'managers' => 'required|array',  // Ensure managers are passed as an array
        //'managers.*' => 'exists:users,id' // Ensure each selected manager exists in the users table
        ]);

        // Handle shop logo if uploaded
        $shopLogoPath = null;
if ($request->hasFile('shop_logo') && $request->file('shop_logo')->isValid()) {
    $shopLogo = $request->file('shop_logo');
    $fileName = time() . '_' . $shopLogo->getClientOriginalName();
    
    // Save the shop logo in both directories
    $shopLogo->storeAs('public/shop_logos', $fileName); 
    $shopLogo->storeAs('public/profile_pictures', $fileName); 
    
    // Set the file path for storing in the database
    $shopLogoPath = $fileName; 
}

try {
    // Create a user for the shop
    $user = User::create([
        'first_name' => $request->shop_name, // Use shop name as first name
        'last_name' => "", // Leave last name empty
        'email' => $request->shop_email,
        'phone_number' => " ", // No phone number provided
        'course_bloc' => " ",  // Default or placeholder value
        'year' => " ",         // Default or placeholder value
        'password' => bcrypt('defaultpassword'), // Default password (hashed)
        'role_id' => 2,        // Assuming role ID 1 is for shops
        'course_id' => $request->course_id,
        'status_id' => 1,      // Default active status
        'profile_picture' => $shopLogoPath, // Use the same path as the shop logo
    ]);

    // Create the shop record
    $shop = Shop::create([
        'shop_name' => $request->shop_name,
        'user_id' => $request->managers[0],
        'shop_description' => " ", // Default or placeholder description
        'course_id' => $request->course_id,
        'status_id' => 1, // Default active status
        'shop_logo' => $shopLogoPath, // Use the same path as the user's profile picture
    ]);
} catch (\Exception $e) {
    // Handle the exception and redirect with an error message
    return redirect()->route('admin.shops')->with('error', 'Failed to create shop. Please try again.');
}


        foreach ($request->managers as $manager) {
            // Skip null values
            if ($manager !== null) {
                GCashInfo::create([
                    'user_id' => $manager,
                    'shop_id' => $shop->id,
                    'gcash_name' => null,
                    'gcash_number' => null,
                    'gcash_limit' => 0
                ]);
            }
        }

        return redirect()->route('admin.shops')->with('success', 'Shop created successfully!');
    }
}