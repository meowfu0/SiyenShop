<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Course;
use App\Models\User;
use App\Models\Status;  // Make sure you have this import
use Illuminate\Support\Facades\Storage;
use App\Models\Manager;  // Assuming you have a model for managers

class CreateShopController extends Controller
{
    public function index()
{
    // Retrieve users with role_id = 2 (Managers)
    $managers = User::where('role_id', 2)->get();  // Use role_id instead of role

    // Retrieve all courses to display in the form
    $courses = Course::all();
    


    // Pass the managers and courses to the view
    return view('livewire.admin.create-shop', compact('managers', 'courses'));
}



public function store(Request $request)
{
    dd($request->all());

    
    $request->validate([
        'shop_name' => 'required|string|max:255',
        'shop_email' => 'required|email',
        'course_id' => 'required|exists:courses,id',  // Ensure that the course_id exists in the courses table
        'user_id' => 'required|exists:users,id',
        'shop_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);
    
    

    $shopData = $request->only(['shop_name', 'shop_email', 'course_id']);
// Create a new shop instance
$shop = new Shop();
$shop->shop_name = $request->input('shop_name');
$shop->shop_email = $request->input('shop_email');
$shop->course_id = $request->input('course_id');
$shop->user_id = 1;  // Example user_id, modify as necessary
$shop->status_id = 1; // Default status, modify as necessary

// Check if a file is uploaded for shop_logo
if ($request->hasFile('shop_logo') && $request->file('shop_logo')->isValid()) {
    // If a file is uploaded, handle the file upload
    $shopLogo = $request->file('shop_logo');
    $fileName = time() . '_' . $shopLogo->getClientOriginalName();
    $path = $shopLogo->storeAs('public/shop_logos', $fileName);  // Store the file in public/shop_logos
    $shop->shop_logo = $fileName;  // Save the file name in the database
}

// Save the shop record in the database
$shop->save();

    
    

    return response()->json(['message' => 'Form data received successfully!']);
    return redirect()->route('admin.shops')->with('success', 'Shop created successfully!');
}


    
}
