<?php

namespace App\Http\Controllers;

use App\Models\GCashInfo;
use Illuminate\Http\Request;

class GCashInfoController extends Controller
{
    
    public function store(Request $request)
    {
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
            \App\Models\GcashInfo::create([
                'gcash_name' => $gcash_name,
                'gcash_number' => $request->gcash_number[$key],
                'gcash_limit' => $request->gcash_limit[$key],
            ]);
        }
    
        // Return success
        return redirect()->back()->with('success', 'Gcash info added successfully!');
    }
}    