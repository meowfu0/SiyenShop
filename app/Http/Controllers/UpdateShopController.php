<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;

class UpdateShopController extends Controller
{
    public function edit($id)
{
    $shop = Shop::with(['g_cash_info', 'course', 'status'])->findOrFail($id);
    $managers = User::where('role_id', 2)->get(); // Fetch users with 'role_id' 2 (managers)
    $courses = Course::all();

    return view('livewire.admin.updateshop', compact('shop', 'managers', 'courses'));
}

    
    public function update(Request $request, $id)
{
    // Validate incoming data
    $request->validate([
        'shop_name' => 'required|string|max:255',
        'course_id' => 'required|exists:courses,id',
        'managers' => 'required|array|min:1', // At least one manager (user) must be provided
        'managers.*' => 'exists:users,id', // Ensure provided manager IDs exist in the users table
        'shop_description' => 'nullable|string|max:500',
    ]);

    // Ensure the selected managers all have role_id = 2
    $managers = User::whereIn('id', $request->managers)
        ->where('role_id', 2)
        ->get();

    if ($managers->isEmpty()) {
        return back()->withErrors(['managers' => 'Invalid manager selection. Please choose valid managers with the appropriate role.']);
    }

    // Find the shop or fail
    $shop = Shop::findOrFail($id);

    // Update the shop record
    $shop->update([
        'shop_name' => $request->shop_name,
        'user_id' => $managers->first()->id, // Assign the first valid manager ID as the primary user
        'shop_description' => $request->shop_description ?? $shop->shop_description,
        'course_id' => $request->course_id,
        'status_id' => $shop->status_id, // Retain the current status
    ]);

    // Return the updated shop view
    return view('livewire.admin.updateshop', compact('shop'));
}

public function uploadUpdate(Request $request, $shopId)
{
    // Find the shop record
    $shop = Shop::with(['user'])->findOrFail($shopId);

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

    // Process shop details from FormData
    $shopData = $request->has('shopData')
        ? json_decode($request->get('shopData'), true)
        : $request->only(['shop_name', 'course_id', 'shop_description', 'managers']);

    // Ensure managers all have role_id = 2
    $managers = User::whereIn('id', $shopData['managers'] ?? [])
        ->where('role_id', 2)
        ->get();

    if ($managers->isNotEmpty()) {
        $shop->user_id = $managers->first()->id; // Assign the first valid manager ID as the primary user
    }

    // Update shop fields
    $shop->shop_name = $shopData['shop_name'] ?? $shop->shop_name;
    $shop->course_id = $shopData['course_id'] ?? $shop->course_id;
    $shop->shop_description = $shopData['shop_description'] ?? $shop->shop_description;
    $shop->shop_logo =  $shopLogoPath;

    // Save updated shop
    $shop->save();

    return redirect(route('admin.shops'))->with('success', 'Shop updated successfully!');
        
}


}
