<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{

   public function handle(Request $request, Closure $next, $roles)
    {
        // Check if user is logged in
        if (!$request->session()->has('usr_id')) {
            return redirect('/login')->with('error', 'Please login first!');
        }

        // Get the role from session
        $userRole = $request->session()->get('role_name'); // using role_name

        // Allow multiple roles separated by |
        $allowedRoles = explode('|', $roles);

        if (!in_array($userRole, $allowedRoles)) {
            return redirect('/login')->with('error', 'Unauthorized access!');
        }

        return $next($request);
    }
}
