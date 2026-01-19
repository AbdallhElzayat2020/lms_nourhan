<?php

namespace App\Http\Middleware;

use App\Models\Redirect;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleRedirects
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip redirect handling for admin routes, API routes, and other internal routes
        if ($request->is('admin/*') ||
            $request->is('api/*') ||
            $request->is('_debugbar/*') ||
            $request->is('storage/*') ||
            $request->is('vendor/*') ||
            $request->is('livewire/*')) {
            return $next($request);
        }

        $currentPath = $request->getPathInfo();

        // Look for a redirect matching the current path
        $redirect = Redirect::findByOldUrl($currentPath);

        if ($redirect) {
            // Increment hit count
            $redirect->incrementHit();

            // Determine redirect type
            $statusCode = $redirect->status_code == '301' ? 301 : 302;

            // Handle both internal and external redirects
            if (filter_var($redirect->new_url, FILTER_VALIDATE_URL)) {
                // External URL
                return redirect($redirect->new_url, $statusCode);
            } else {
                // Internal URL
                return redirect($redirect->new_url, $statusCode);
            }
        }

        return $next($request);
    }
}
