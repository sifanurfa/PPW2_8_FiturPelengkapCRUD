<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!in_array(Auth::user()->level, ['admin', 'internal_reviewer'])) {
            return redirect()->back();
        }
        return $next($request);
    }
}
