<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Front\BaseController;
use App\Http\Requests\Front\ProfileAddressRequest;

class ProfileController extends BaseController
{




    public function index()
    {

        return view('front.profile.index');
    }


    // ---------------------------------


    public function editAddress()
    {
        return view('front.profile.address.edit');
    }

    // ------------------------------------
    public function updateAddress(ProfileAddressRequest $request)
    {




        try {

            DB::beginTransaction();

            $validated =  $request->validated();

            user()->addressDetails()->updateOrcreate(
                [
                    'user_id' => user()->id
                ],
                $validated
            );


            DB::commit();

            return redirect()->route('front.profile')->with(['success' =>  __('front.message_succ_update_profile')]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with(['exception_error' => __('front.exception_error')]);
        }
    }

    // ------------------------------------


    // ---------------------------------
    // ---------------------------------
    // ---------------------------------
    // ---------------------------------
    // ---------------------------------
}
