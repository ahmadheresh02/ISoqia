<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and has admin privileges
        if (Auth::check() && Auth::user()->role == 'admin') { // Assuming you have an `is_admin` column
            return $next($request);
        }

        // Redirect non-admin users
        return redirect('/')->with('error', 'You do not have admin access.');
    }
}
