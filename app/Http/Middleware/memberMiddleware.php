<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class MemberMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('officialmember')->check()) {
            // you can access the logged in officialmember
            $user = Auth::guard('officialmember')->user();
                return $next($request);
        } 
        // if not logged in
        return redirect()->route('Member.Login');
    }
}
