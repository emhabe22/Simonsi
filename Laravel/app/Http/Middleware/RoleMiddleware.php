<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $authHeader = $request->header('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $token = str_replace('Bearer ', '', $authHeader);
        $decoded = base64_decode($token);

        if (!$decoded || !str_contains($decoded, '|')) {
            return response()->json(['message' => 'Invalid token'], 401);
        }

        [$email, $timestamp] = explode('|', $decoded);

        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 401);
        }

        // Cek roles
        if (!in_array($user->role, $roles)) {
            return response()->json(['message' => 'Forbidden: Access denied'], 403);
        }

        // Inject user ke request → bisa dipakai di controller
        $request->setUserResolver(fn () => $user);

        return $next($request);
    }
}
