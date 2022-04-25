<?php

namespace App\Http\Middleware;

use Closure;

class SharInDashboardView
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
        $notifications_count = admin()->unreadNotifications->count();

        view()->share('navbar', ['notify_count' => $notifications_count]);

        return $next($request);
    }
}
