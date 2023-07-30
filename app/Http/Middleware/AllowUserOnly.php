<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AllowUserOnly
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $is_user = empty($request->user()) ? false : $request->user()->is_admin;
        if ($is_user == 0) {
            return $next($request);
        }
        return redirect()->route('dashboard');

    }
}
