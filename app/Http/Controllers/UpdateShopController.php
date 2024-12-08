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

    public function uploadUpdate(Request $request, $id)
    {
        try {
            $shop = Shop::findOrFail($id);
    
            // Validate the incoming data
            $data = $request->validate([
                'shop_name' => 'required|string|max:255',
                'course_id' => 'required|exists:courses,id',
                'shop_description' => 'required|string|max:255',
                'managers' => 'array|nullable',
                'managers.*' => 'exists:users,id', // Ensure managers exist
            ]);
    
            // Update the shop
            $shop->update($data);
    
            // Return success response
            return response()->json(['success' => true, 'message' => 'Shop updated successfully.']);
        } 
        catch (\Exception $e) {
            \Log::error('Error updating shop: ' . $e->getMessage());  // Log the error
            return response()->json(['success' => false, 'message' => 'An error occurred while updating the shop.'], 500);
        }
    }
    

}
