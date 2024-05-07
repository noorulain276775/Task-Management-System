<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RegularUserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You do not have permission to access this page !');
        }

        $userRole = Auth::user()->type;
        if ($userRole == 0) {
            return $next($request);
        }

        if ($userRole == 2) {
            return redirect()->route('superadmin');
        }

        if ($userRole == 1) {
            return redirect()->route('admin');
        }
    }
}
