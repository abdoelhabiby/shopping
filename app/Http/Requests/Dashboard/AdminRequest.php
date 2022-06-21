<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
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
        $permissions = $this->getAdminPermissionsCanTake();
        $rules  = [
            "name" => "required|string|min:3|max:100",
            "email" => "required|string|email|max:100|" . Rule::unique('admins', 'email')->ignore($this->admin),
            "password" => "required|string|min:8|max:100|confirmed",
            "permissions" => 'array',
            "permissions.*" => 'exists:permissions,name|' . Rule::in($permissions),
        ];


        if (in_array($this->getMethod(), ['PUT', 'PATCH'])) {

            $rules["password"] = "sometimes|nullable|min:6|max:100|confirmed";
        }


        return $rules;
    }




    public function messages()
    {
        return [

            "permissions.*.exists" => 'input a valid value !!!!!',
            "permissions.*.in" => 'input a valid value !!!!!',

        ];
    }


    //--------------get permissions can admin take -------


    protected function getAdminPermissionsCanTake() : array
    {
        // get all permission can take
        $roles_permissions = Role::whereNotIn('name', ['super_admin', 'admin'])
            ->where('guard_name', 'admin')
            ->whereHas('permissions')
            ->with(['permissions' => function ($q) {
                return $q->select('name');
            }])
            ->select(['id', 'name'])
            ->get();

        $permissions = [];

        foreach ($roles_permissions as $role_permissions) {
            $get_permissions =  collect($role_permissions->permissions)->pluck('name')->toArray();
            $permissions = array_merge($get_permissions, $permissions);
        }

        return $permissions;
    }


}
