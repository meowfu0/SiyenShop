<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\GCashInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class shopPageController extends Controller
{
    public function index()
    {
         // Fetch all the user rows from the database
         $shops = Shop::with(['user', 'course', 'status', 'g_cash_info'])->get();
         return view('livewire.admin.admin-shops', compact('shops'));
    }

    public function show($id)
    {
       // Retrieve the user along with course and status using eager loading
        $shop = Shop::with(['g_cash_info', 'course', 'status'])->findOrFail($id);

    // Return the data as JSON
        return response()->json([
            'shop' => $shop,

        ]);
    }

    public function update(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);

        // Update the user's profile
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function create(Request $request, Shop $shop)
    {
        //
    }


    

}

