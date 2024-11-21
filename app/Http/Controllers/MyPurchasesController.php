<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class MyPurchasesController extends Controller
{
    public function index()
    {
        // Fetch orders of the authenticated user
        $orders = Order::where('user_id', auth()->id())->get();

        return view('user.mypurchases', compact('orders'));
    }
}
