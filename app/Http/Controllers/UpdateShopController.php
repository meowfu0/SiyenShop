<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\User;
use App\Models\Course;

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
        // Find the shop or fail
        $shop = Shop::findOrFail($id);

        // Update the shop with the provided data
        $shop->update($request->all());

        // Return a view with the updated shop
        return view('livewire.admin.updateshop', compact('shop'));
    }

    public function uploadUpdate(Request $request, $shopId)
{
    // Find the shop record
    $shop = Shop::findOrFail($shopId);

    // Check if the request has a file upload
    if ($request->hasFile('shop_logo')) {
        // Validate file (optional)
        $request->validate([
            'shop_logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        if ($shop->shop_logo) {
            // Delete old logo if it exists
            Storage::delete($shop->shop_logo);
        }

        $filePath = $request->file('shop_logo')->store('logos', 'public');
        $shop->shop_logo = $filePath;
    }

    // Check for JSON or shopData in FormData
    $shopData = $request->has('shopData')
        ? json_decode($request->get('shopData'), true)
        : $request->only(['shop_name', 'course_id', 'shop_description', 'managers']);

    // Update shop details
    $shop->shop_name = $shopData['shop_name'] ?? $shop->shop_name;
    $shop->course_id = $shopData['course_id'] ?? $shop->course_id;
    $shop->shop_description = $shopData['shop_description'] ?? $shop->shop_description;

    /*
    // Update managers if provided
    if (!empty($shopData['managers'])) {
        $shop->managers()->sync($shopData['managers']); // Assuming a many-to-many relationship
    }
*/
    // Save updated shop
    $shop->save();

    return response()->json(['success' => true, 'message' => 'Shop updated successfully!']);
}
    

}
