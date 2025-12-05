<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

         if (!$request->session()->has('usr_id')) {
            // Redirect to login page with optional message
            return redirect('/login')->with('error', 'Unauthorized! Please login first.');
        }

        return $next($request);
    }
}
