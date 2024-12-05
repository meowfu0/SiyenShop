<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        \Log::info('Update request received for shop ID: ' . $shopId);
    
        // Find the shop record
        $shop = Shop::findOrFail($shopId);
        \Log::info('Shop Found:', $shop->toArray());
    
        // Validate request
        $request->validate([
            'shop_name' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'shop_description' => 'nullable|string',
            'shop_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Handle file upload
        if ($request->hasFile('shop_logo')) {
            if ($shop->shop_logo) {
                // Delete old logo if it exists
                Storage::delete('public/' . $shop->shop_logo);
            }
    
            $filePath = $request->file('shop_logo')->store('shop_logos', 'public');
            $shop->shop_logo = $filePath;
            \Log::info('Shop logo updated: ' . $filePath);
        }
    
        // Update shop details
        $shop->shop_name = $request->input('shop_name', $shop->shop_name);
        $shop->course_id = $request->input('course_id', $shop->course_id);
        $shop->shop_description = $request->input('shop_description', $shop->shop_description);
    
        // Update managers (uncomment if required and managers relation is defined)
        /*
        if ($request->has('managers')) {
            $managers = $request->input('managers', []);
            $shop->managers()->sync($managers);
            \Log::info('Managers updated:', $managers);
        }
        */
    
        // Save updated shop
        $shop->save();
        \Log::info('Shop updated successfully: ' . $shopId);
    
        return redirect(route('admin.shops'))->with('success', 'Shop updated successfully!');
        
        //response()->json(['success' => true, 'message' => 'Shop updated successfully!']);
    }
    
    

}
