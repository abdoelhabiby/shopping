<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
        $rules  = [
            "name" => "required|string|min:3|max:100",
            "email" => "required|string|email|max:100|" . Rule::unique('admins', 'email')->ignore($this->admin),
            "password" => "required|string|min:6|max:100|confirmed",
        ];


        if (in_array($this->getMethod(), ['PUT', 'PATCH'])) {

            $rules["password"] = "sometimes|nullable|min:6|max:100|confirmed";
        }


        return $rules;
    }
}
