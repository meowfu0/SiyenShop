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
        ]);

        // Handle shop logo if uploaded
        $shopLogoPath = null;
        if ($request->hasFile('shop_logo') && $request->file('shop_logo')->isValid()) {
            $shopLogo = $request->file('shop_logo');
            $fileName = time() . '_' . $shopLogo->getClientOriginalName();
            $shopLogo->storeAs('public/shop_logos', $fileName); // Save file in storage
            $shopLogoPath = 'storage/shop_logos/' . $fileName; // Accessible URL
        }

        try {
            // Create a user for the shop
            $user = User::create([
                'first_name' => $request->shop_name, // Use shop name for user first name
                'last_name' => "", // No last name provided
                'email' => $request->shop_email,
                'phone_number' => " ",
                'course_bloc' => " ",
                'year' => " ",
                'password' => bcrypt('defaultpassword'), // Ensure passwords are hashed
                'role_id' => 2, // Assuming role_id 2 is for shops
                'course_id' => $request->course_id,
                'status_id' => 1, // Assuming 1 is the default active status
                'profile_picture' => $shopLogoPath, // No profile picture by default
            ]);

            // Create the shop using mass assignment
            $shop = Shop::create([
                'shop_name' => $request->shop_name,
                'user_id' => $user->id,
                'shop_description' => null,
                'course_id' => $request->course_id,
                'status_id' => 1, // Default active status
                'shop_logo' => $shopLogoPath,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('admin.shops')->with('error', 'Failed to create shop. Please try again.');
        }

        foreach ($request->managers as $manager) {
            // Skip null values
            if ($manager !== null) {
                GCashInfo::create([
                    'user_id' => $manager,
                    'shop_id' => $shop->id,
                    'gcash_name' => " ",
                    'gcash_number' => " ",
                    'gcash_limit' => 0
                ]);
            }
        }

        return redirect()->route('admin.shops')->with('success', 'Shop created successfully!');
    }
}