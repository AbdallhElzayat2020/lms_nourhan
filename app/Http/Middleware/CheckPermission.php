<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Admin has all permissions
        if ($user->isAdmin()) {
            return $next($request);
        }

        // Check if permission contains OR (|) operator
        if (strpos($permission, '|') !== false) {
            $permissions = explode('|', $permission);
            $hasPermission = false;

            foreach ($permissions as $perm) {
                if ($user->hasPermission(trim($perm))) {
                    $hasPermission = true;
                    break;
                }
            }

            if (!$hasPermission) {
                abort(403, 'Unauthorized action.');
            }
        } else {
            // Check if user has the required permission
            if (!$user->hasPermission($permission)) {
                abort(403, 'Unauthorized action.');
            }
        }

        return $next($request);
    }
}
