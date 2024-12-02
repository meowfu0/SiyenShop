<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle(Request $request, Closure $next)
    {
        // Check if user is logged in
        if (Auth::check()) {
            // Check if user role is '2' (business manager)
            if (Auth::user()->role_id === 2) {
                return redirect('/shop'); // Redirect to shop route if role is 2
            } else {
                return redirect('/home'); // Redirect to home if not a business manager
            }
        }

        // Proceed with the original request if no user is logged in
        return $next($request);
    }
}
