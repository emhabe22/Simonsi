<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('api_token')) {
            $request->headers->set('Authorization', 'Bearer ' . session('api_token'));
        }

        return $next($request);
    }
}
