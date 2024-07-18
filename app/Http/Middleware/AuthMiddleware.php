<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = auth()->user();

        if (!$user)
        {
            return redirect(route('auth.pages.login'));
        }

        $user->load('role');

        foreach($roles as $role)
        {
            if($role === $user->role->role_name)
            {
                return $next($request);
            }
        }

        if (count($roles) > 0)
        {
            return redirect(route('auth.pages.login'));
        }

        return $next($request);
    }
}
