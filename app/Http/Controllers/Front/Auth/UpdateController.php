<?php

namespace App\Http\Controllers\Front\Auth;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UpdateController extends Controller
{

    public function edit()
    {
        return view('front.profile.edit');
    }

    // ------------------------------------
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:30',
            'email' => 'required|email|' . Rule::unique('users', 'email')->ignore(user()->id)
        ]);


        try {

            DB::beginTransaction();

            user()->update($validated);

            DB::commit();

            return redirect()->route('front.profile')->with(['success' =>  __('front.message_succ_update_profile')]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with(['exception_error' => __('front.exception_error')]);
        }



    }

    // ------------------------------------



    // ------------------------------------
    public function changePassword()
    {
        return view('front.profile.change_password');
    }
    // ------------------------------------

    public function updateChangePassword(Request $request)
    {
        if (!Hash::check($request->current_password, user()->password)) {


            $error = \Illuminate\Validation\ValidationException::withMessages([
                'current_password' => [__('front.exception_current_password')],
            ]);

            throw $error;
        }


        $validated = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);



        try {

            DB::beginTransaction();

            user()->update(['password' => hash::make($validated['password'])]);

            DB::commit();


            return redirect()->route('front.profile')->with(['success' =>  __('front.message_succ_update_profile')]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with(['exception_error' => __('front.exception_error')]);
        }
    }



    // ------------------------------------
}
