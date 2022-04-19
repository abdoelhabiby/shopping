<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfAddressNotExists
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

        if (auth('web')->check() && user()->addressDetails) {

            return $next($request);
        }

        session('referer_to_checkout_route',$request->header('referer'));

        return redirect()->route('front.profile.address.edit')->with(['exception_error' => __('front.add_address_details')]);
    }
}
