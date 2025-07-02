<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use TE;

class UserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        
        if ($user && !$user->is_active) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your account is not active. Please contact support.');
        }

        if ($user && $user->is_ban) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your account is banned. Please contact support.');
        }

        return $next($request);
    }
}
