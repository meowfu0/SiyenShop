<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleAccessValidate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles  (roles passed as parameters)
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to access this page.');
        }

        // Check if the user has the required role
        $user = Auth::user();

        if ($user->role->role_name !== $role) {
            if ($user->role->role_name === 'Admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($user->role->role_name === 'Business Manager') {
                return redirect()->route('shop.dashboard');
            }

            if ($user->role->role_name === 'Student') {
                return redirect()->route('home');
            }
        }

       // Redirect 'admin' users to the admin dashboard (if they are admin)
        

        return $next($request);
    }
}