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
        // Fetch all shops with related data, including business managers and their users
        $shops = Shop::with(['user', 'course', 'status', 'businessManagers.user'])->get();
    
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

    public function search(Request $request)
    {
        $query = Shop::with(['course', 'status', 'user']); // Eager load relationships

        // Apply search filter if the search query is provided (for names and role)
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function($q) use ($request) {
                $q->where('shop_name', 'like', '%' . $request->search . '%');
            });
        }
    
        // Apply course filter if the course parameter is provided
        if ($request->has('courseCall') && !empty($request->course)) {
            $query->whereHas('course', function($q) use ($request) {
                $q->where('course_name', $request->course);
            });
        }

        // Return the filtered users
        return $query->get();
    }

    public function runResults(Request $request)
    {
        // Get users from the search method
        $shops = $this->search($request);

        // Return the filtered users as JSON
        return response()->json($shops);
    }

    

}

