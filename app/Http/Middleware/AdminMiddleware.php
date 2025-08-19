<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated and has admin role
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            // Redirect to login if not authenticated
            if (!Auth::check()) {
                return redirect()->route('login')
                    ->with('error', 'Anda perlu log masuk untuk mengakses halaman ini.');
            }
            
            // Redirect to dashboard if not admin
            return redirect()->route('pemohon.dashboard')
                ->with('error', 'Anda tidak mempunyai kebenaran untuk mengakses halaman admin.');
        }

        return $next($request);
    }
}