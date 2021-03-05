<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CompanyRegistered
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
        if (auth()->user()->company) {
            return abort("412", "Already have company");
        }
        return $next($request);
    }
}
