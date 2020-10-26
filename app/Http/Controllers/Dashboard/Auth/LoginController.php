<?php

namespace App\Http\Controllers\Dashboard\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{

    use ThrottlesLogins;
    //----------show form login -------------

    public function showFormLogin()
    {
        return view('dashboard.auth.login');
    }

    //---------------------------------------------------

    //--------------------login submit-------------------

    public function login(Request $request)
    {
        try {
            $validate = $request->validate([
                "email" => "required",
                "password" => "required",
            ]);

            $remember = $request->has('remember_me') ? true : false;

            if (auth('admin')->attempt($validate, $remember)) {
                $default = route('dashboard.home');

                return redirect()->intended($default);
            }

            return redirect()->back()->with(['error' => 'invalid data']);
        } catch (\Throwable $th) {
            Log::alert($th);

            return redirect()->back()->with(['error' => 'invalid data']);
        }
    }

    //---------------------------------------------------
    //---------------------------------------------------
    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // if ($response = $this->loggedOut($request)) {
        //     return $response;
        // }

        return redirect()->route('dashboard.form_login');

    }
    //---------------------------------------------------
    //---------------------------------------------------
    //---------------------------------------------------
    //---------------------------------------------------
    //---------------------------------------------------
    //---------------------------------------------------
}
