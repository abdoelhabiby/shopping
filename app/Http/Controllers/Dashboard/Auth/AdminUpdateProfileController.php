<?php

namespace App\Http\Controllers\Dashboard\Auth;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminUpdateProfileController extends Controller
{

    public function index()
    {
        return view('dashboard.auth.edit-profile');
    }



    public function update(Request $reuqest)
    {

        $rules  = [
            "name" => "required|string|min:3|max:100",
            "email" => "required|string|email|max:100|" . Rule::unique('admins', 'email')->ignore(admin()),
            "password" => "sometimes|nullable|min:8|max:100|confirmed",

        ];


        $validated = $reuqest->validate($rules);


        try {


            $collection = collect($validated);

            if ($collection->has('password') &&  $collection->get('password') && !empty(trim($collection->get('password')))) {
                $collection->put('password', Hash::make($collection->get('password')));
            } else {
                $collection->forget('password');
            }


            admin()->update($collection->all());
            return redirect()->route('dashboard.profile.index')->with(['success' => "success Update"]);


        } catch (\Throwable $th) {

            Log::alert($th);

            return $this->backWithError();
        }
    }
}
