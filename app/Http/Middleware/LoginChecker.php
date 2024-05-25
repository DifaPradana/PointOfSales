<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginChecker
{
    public function handle($request, Closure $next)
    {
        if (!auth()->check()) {
            // User is not authenticated, redirect to the login page
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }

        // User is authenticated, allow the request to proceed
        return $next($request);
    }
}
