<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddBearerToken
{
    public function handle(Request $request, Closure $next)
    {
        if (session('bearer_token')) {
            $request->headers->set('Authorization', 'Bearer ' . session('bearer_token'));
        }

        return $next($request);
    }
}
