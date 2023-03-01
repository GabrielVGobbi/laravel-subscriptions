<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role, $permission = null)
    {
        if (!Auth::check()) {
            abort(403);
        }

        if ($request->user()->hasRole(config('app.permission_released'))) {
            return $next($request);
        }

        if (!$request->user()->hasRole($role)) {
            abort(404);
        }

        if ($permission !== null && !$request->user()->can($permission)) {
            abort(404);
        }

        return $next($request);
    }
}
