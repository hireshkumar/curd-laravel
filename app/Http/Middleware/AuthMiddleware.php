<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('uid')) {
            return redirect()->route('login')->with('error', 'Please log in first');
        }

        return $next($request);
    }
}
