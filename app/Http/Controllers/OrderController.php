<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Shop;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function index()
    {
        // Fetch the orders from the database
        $orders = Order::all(); // You can customize this to apply filters, pagination, etc.

        // Return the orders data as a JSON response
        return response()->json($orders);
    }
    public function updateStatus(Request $request)
    {
    
        $validated = $request->validate([
            'order_id' => 'required|integer',  // Validate order ID
            'status_id' => 'required|integer', // Validate status ID
        ]);
    
        // Find the order by ID from the request
        $order = Order::find($validated['order_id']);  // Use the order ID passed in the request
    
    
        // Update the order's status
        $order->order_status_id = $validated['status_id'];  // Update with the new status ID
        $order->save();
    
        return response()->json(['message' => 'Order status updated successfully']);
    }
    public function getShop()
    {
        \Log::debug('Hellow world');
        
        // Fetch the shop for the authenticated user (since each user has one shop)
        if (auth()->check()) {
            // User is logged in
            \Log::debug('User is logged in.');
        } else {
            // User is not logged in
            \Log::debug('User is not logged in.');
        }
        
        $shop = Shop::where('user_id', auth()->id())->first();
        //return response()->json($shop);

        if (!$shop) {
            \Log::debug('Shop not found.');
            return redirect()->route('shop.create')->with('error', 'Shop not found. Please create one.');
        }
        return view('livewire.shop.shop-orders', compact('shop'));
    }
    
    

    
}

