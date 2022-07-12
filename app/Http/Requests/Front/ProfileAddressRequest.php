<?php

namespace App\Http\Requests\Front;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'user_id' => "required|" . Rule::unique('user_address_details','user_id')->ignore(user()->id,'user_id'),
            'first_name' => "required|string|min:3|max:225",
            'last_name' => "required|string|min:3|max:225",
            'email' => "required|email",
            'address' => "required|string|min:10|max:500",
            'second_address' => "sometimes|nullable|string|min:10|max:500",
            'phone' => "required|digits_between:5,11",
            'second_phone' => "sometimes|nullable|digits_between:5,11",
        ];
    }




}
