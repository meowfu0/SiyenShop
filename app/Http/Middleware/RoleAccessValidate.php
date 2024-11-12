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
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if the user is authenticated and has a role in the provided list of roles
        $user = Auth::user();
        
        if (!$user || !in_array($user->roles->role_name, $roles)) {
            // Redirect to a specific page or abort with a 403 Forbidden status
            return abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}