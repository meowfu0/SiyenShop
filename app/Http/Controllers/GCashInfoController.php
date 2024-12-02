<?php

namespace App\Http\Controllers;

use App\Models\GCashInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class GCashInfoController extends Controller
{
    
    public function store(Request $request)
    {
        $user = Auth::id();

        $gcashInfo = GCashInfo::where('user_id', $user)->first();
        $shopId = $gcashInfo->shop_id; // Access shop_id

        // Validate the incoming request
        $validated = $request->validate([
            'gcash_name' => 'required|array',
            'gcash_name.*' => 'required|string|max:255',
            'gcash_number' => 'required|array',
            'gcash_number.*' => 'required|string|max:255',
            'gcash_limit' => 'required|array',
            'gcash_limit.*' => 'required|string|max:255',
        ]);
    
        // Save each Gcash info
        foreach ($request->gcash_name as $key => $gcash_name) {
            DB::table('g_cash_infos')->insert([
                'user_id' => $user,
                'shop_id' => $shopId,
                'gcash_name' => $gcash_name,
                'gcash_number' => $request->gcash_number[$key],
                'gcash_limit' => $request->gcash_limit[$key],
                'created_at' => now(),
            ]);
            
        }
    
        // Return success
        return redirect()->back()->with('success', 'Gcash info added successfully!');
    }




    public function destroy($id)
    {
        // Find the GCashInfo record by its ID
        $gcashInfo = GCashInfo::find($id);
    
        // Check if the record exists
        if ($gcashInfo) {
            $gcashInfo->delete(); // Soft delete or forceDelete() if you need a permanent deletion
            return response()->json(['success' => true, 'message' => 'GCash info deleted successfully.']);
        }
    
        return response()->json(['success' => false, 'message' => 'GCash info not found.'], 404);
    }
    
}    