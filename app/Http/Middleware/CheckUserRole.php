<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GcashInfo;

class CheckUserRole
{
    public function handle(Request $request, Closure $next)
    {
        // Check if user is logged in and is a business manager
        if (Auth::check() && Auth::user()->role === 'business manager') {
            // Look for the user ID in the GcashInfo model
            $gcashInfo = GcashInfo::where('user_id', Auth::id())->first();

            // If a GcashInfo record is found, redirect to the shop dashboard with shop_id
            if ($gcashInfo) {
                return redirect()->route('dashboard', ['shop_id' => $gcashInfo->shop_id]);
            }
        }

        // If not a business manager or no GcashInfo record, proceed with the original request
        return $next($request);
    }
}
