<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;

class UpdateShopController extends Controller
{
    public function edit($id)
{
    $shop = Shop::findOrFail($id);
    return view('livewire.admin.updateshop', compact('shop')); // Show the edit form
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
