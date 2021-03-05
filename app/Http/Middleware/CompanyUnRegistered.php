<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CompanyUnRegistered
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()->company) {
            return abort("412", "Register your company first");
        }
        return $next($request);
    }
}
