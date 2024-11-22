<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        // Check if the user has any of the specified roles
        if ($user && in_array($user->role, $roles)) {
            return $next($request);
        }

        // Redirect or return a forbidden response
        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
