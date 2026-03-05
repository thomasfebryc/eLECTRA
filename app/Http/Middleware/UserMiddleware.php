<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'user') {
            return $next($request);
        }
        // Jika admin mencoba akses route user, redirect ke halaman admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect('/admin');
        }
        return redirect('/')->with('error', 'Unauthorized access.');
    }
}
