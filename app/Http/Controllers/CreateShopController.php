<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Course;
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
        'shop_email' => 'required|email|unique:shops,shop_email',
        'course_id' => 'required|exists:courses,id',
        'user_id' => 'required|exists:users,id',
        'shop_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Create a new Shop instance
    $shop = new Shop();
    $shop->shop_name = $request->shop_name;
    $shop->shop_email = $request->shop_email;
    $shop->user_id = $request->user_id;
    $shop->course_id = $request->course_id;
    
    
    

    // Handle shop logo if uploaded
    if ($request->hasFile('shop_logo') && $request->file('shop_logo')->isValid()) {
        $shopLogo = $request->file('shop_logo');
        $fileName = time() . '_' . $shopLogo->getClientOriginalName();
        $shopLogo->storeAs('public/shop_logos', $fileName); // Save file in storage
        $shop->shop_logo = $fileName; // Save logo path in database
    }

    // Save the shop to the database
    $shop->save();

    // Create a user record for the shop
    User::create([
        'first_name' => $request->shop_name,
        'last_name' => "", 
        'email' => $request->shop_email,
        'role_id' => 2,
        'course_id' => $request->course_id,
    ]);

    
    return redirect()->route('admin.shops')->with('success', 'Shop created successfully!');
}

}
