<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    // Changed to boolean check
    if (Auth::user()->is_admin !== true) {
        return redirect('/')->with('error', 'Access denied');
    }

    return $next($request);
}
}