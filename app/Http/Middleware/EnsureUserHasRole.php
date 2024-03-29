<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $roles): Response
    {
        if (str_contains($roles, '|')){
            $rolesArray = explode('|', $roles);
            foreach ($rolesArray as $role) {
                if ($request->user()->hasRole($role)) {
                    return $next($request);
                }
            }
        }
        else{
            if ($request->user()->hasRole($roles)) {
                return $next($request);
            }
        }
        abort(404);
    }
}
