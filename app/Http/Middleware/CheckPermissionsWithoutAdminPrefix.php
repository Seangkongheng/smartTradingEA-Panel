<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermissionsWithoutAdminPrefix
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next)
    {
        $routeName = $request->route()->getName(); // e.g. 'admin.user.index'

        // Strip 'admin.' prefix if exists
        if (str_starts_with($routeName, 'admin.')) {
            $routeName = substr($routeName, strlen('admin.'));
        }

        if (!auth()->user() || !auth()->user()->can($routeName)) {
            return response()->view('dashboard::components.403', [], 403);
        }

        return $next($request);
    }
}
