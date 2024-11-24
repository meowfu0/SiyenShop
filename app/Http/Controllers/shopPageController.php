<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\GCashInfo;
use Illuminate\Http\Request;

class shopPageController extends Controller
{
    public function index()
    {
         // Fetch all the user rows from the database
         $shops = Shop::with(['user', 'course', 'status'])->get();
         return view('livewire.admin.admin-shops', compact('shops'));
    }

    public function show($id)
    {
       // Retrieve the user along with course and status using eager loading
        $shop = Shop::with(['g_cash_info', 'course', 'status'])->findOrFail($id);

    // Return the data as JSON
        return response()->json([
            'shop' => $shop,
            'g_cash_info' => $shop->g_cash_info, // Include Gcash info along with shop
        ]);
    }


    

}

