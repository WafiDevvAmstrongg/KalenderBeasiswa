<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserPermission
{
    public function handle($request, Closure $next)
    {
        if (auth()->user()->can('dashboard-permission', 'artikel-permission')) {
            return $next($request);
        }
        return abort(403);
    }
}
