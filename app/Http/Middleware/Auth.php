<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Auth
{
    const AUTH = 'auth_token';

    public function handle(Request $request, Closure $next)
    {
        $value = $request->cookie(self::AUTH);
        if (!$value) {
            return redirect()->route('login');
        }
        return $next($request);
    }
}
