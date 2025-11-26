<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();

        if (!$user) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
            return response()->view('errors.401', [], 401);
        }

        if (!in_array($user->role, $roles)) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Forbidden: Access denied'], 403);
            }
            return response()->view('errors.403', [], 403);
        }

        return $next($request);
    }
}
