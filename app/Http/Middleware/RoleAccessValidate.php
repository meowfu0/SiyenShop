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

        // Debugging: Log the user's role and required role
        \Log::info('User Role: ' . $user->role->role_name);
        \Log::info('Required Role: ' . $role);
        
        if ($user->role->role_name !== $role) {
            return redirect()->route('home')->with('unauthorized', 'You do not have access to this feature');
        }

       // Redirect 'admin' users to the admin dashboard (if they are admin)
        if ($user->role->role_name === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}