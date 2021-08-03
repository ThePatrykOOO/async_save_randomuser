<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class SimpleTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, \Closure $next)
    {
        $config = collect(config('simple_token_user'));
        $username = $request->getUser();
        $password = $request->getPassword();
        if (!$config->has($username)) {
            abort(403);
        }
        if (!in_array($password, $config->get($username))) {
            abort(403);
        }
        return $next($request);
    }
}
