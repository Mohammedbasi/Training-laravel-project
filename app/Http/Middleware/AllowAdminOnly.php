<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AllowAdminOnly
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user_is_admin = empty($request->user()) ? false : $request->user()->is_admin;
        if ($user_is_admin == 1) {
            return $next($request);
        }
        return redirect()->route('dashboard');

    }
}
