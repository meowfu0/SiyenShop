<?php

namespace App\Http\Livewire;

use App\Models\Shop;
use App\Models\Order;
use Livewire\Component;
use Illuminate\Http\Request;

class ShopOrders extends Component
{
    public function store(Request $request)
    {
        // Validate request data
        $data = $request->validate([
            'shop_id' => 'required|integer',
            'user_id' => 'required|integer',
            'order_status_id' => 'required|integer',
            'total_amount' => 'required|numeric',
            'supplier_price_total_amount' => 'required|numeric',
            'total_items' => 'required|integer',
            'order_date' => 'required|date',
            'reference_number' => 'required|string',
            'proof_of_payment' => 'nullable|string'
        ]);
    }

    public function render()
    {
        // Check if the user is authenticated
        if (!auth()->check()) {
            // Redirect or return an error view if the user is not logged in
            return redirect()->route('login')->with('message', 'You must be logged in to view your shop.');
        }

        // Fetch the shop for the authenticated user
        $shop = Shop::where('user_id', auth()->id())->first();

        // If no shop is found, redirect with an error message
        if (!$shop) {
            return redirect()->route('home')->with('message', 'Shop not found.');
        }

        // Fetch orders for the shop
        $orders = Order::where('shop_id', $shop->id)->get();

        // Return the view with the shop and orders data
        return view('livewire.shop.shop-orders', compact('shop', 'orders'));
    }
}
?>

