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
    $shop = Shop::findOrFail($id);
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
}
