<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (! $user->is_admin) {
            return to_route('backend.dashboard.index');
        }

        return $next($request);
    }
}
