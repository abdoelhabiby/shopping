<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MakeNotifyAsRead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        try {

            if ($request->has('notify') && Auth::guard($guard)->check()) {

                if($guard === 'admin'){

                    admin()->notifications()->where('id',$request->get('notify'))->first()->markAsRead();
                }

            }

            return $next($request);



        } catch (\Throwable $th) {

            Log::alert($th);

            return $next($request);

        }


    }
}
