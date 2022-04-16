<?php

namespace App\Http\Middleware;

use Closure;

class MergeRequestUserId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (auth('web')->check()) {
            $request->merge([
                "user_id" => user()->id
            ]);
        }

        return $next($request);
    }
}
