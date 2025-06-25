<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HasRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $routeRoles): Response
    {

        $routeRoles = explode('|', $routeRoles);

        $userRoles = explode(',', $request->user()->roles);

        $hasRole = array_intersect($routeRoles, $userRoles);

        if (count($hasRole) === 0) abort(401, 'Unauthorized');


        return $next($request);
    }
}
