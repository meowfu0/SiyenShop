<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use App\Models\ProductVariant;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Shop;
use App\Models\User;
use App\Mail\OrderStatusUpdate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


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
        $shop = Shop::where('user_id', auth()->id())->first();
        $orders = Order::where('shop_id', $shop->id)->get();
        $orderItems = OrderItem::with(['product', 'productVariant'])->whereIn('order_id', $orders->pluck('id'))->get();
        $variant_item = ProductVariant::all();
        $categories = Category::all();
        $customer = User::whereIn('id', $orders->pluck('user_id'))->get();
        return view('livewire.shop.shop-orders', compact('orders', 'orderItems', 'variant_item', 'categories', 'shop', 'customer'));
    }
    public function updateStatus(Request $request)
    {
        $validated = $request->validate([
            'currentCustomer' => 'required|integer',
            'order_id' => 'required|integer',  
            'status_id' => 'required|integer',
            'denial_reason' => 'required|string',
            'denial_comment' => 'required|string' 
        ]);
    
        $order = Order::find($validated['order_id']);
        $shop = Shop::where('user_id', auth()->id())->first();
        $order->order_status_id = $validated['status_id'];
        $order->denial_reason = $validated['denial_reason'];
        $order->denial_comment = $validated['denial_comment'];
        
        $order->timestamps = false; 
        $order->save();

        $id = $validated['currentCustomer'];
        $user = User::where('id', $id)->select('id', 'first_name', 'last_name', 'email')->first();
        $orderItems = OrderItem::with(['product', 'productVariant'])->whereIn('order_id', $order->pluck('id'))->get();
        $categories = $orderItems->map(function ($orderItem) {
            return Category::where('id', $orderItem->product->category_id)->first();
        });
        
        $variant_item = ProductVariant::all();
       
        Mail::to($user->email)->send(new OrderStatusUpdate($user, $order, $orderItems, $categories, $shop, $variant_item));

        return response()->json(['message' => 'Order status updated successfully']);
    }
    public function getOrders()
    {
        $shop = Shop::where('user_id', auth()->id())->first();
        $orders = Order::where('shop_id', $shop->id)->get();
      
        return response()->json($orders);
    }
    public function processDataTable(Request $request)
    {
        $dataTable = $request->all();
    
        $htmlContent = view('livewire.shop.order-print-layout', ['dataTable' => $dataTable])->render();

        return response()->json(['success' => true, 'htmlContent' => $htmlContent]);
    }
    
}

