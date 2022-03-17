<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Permission;

class TestControler extends Controller
{


    public function test()
    {

        $folder_path = public_path('images/products/410');

        if (!File::exists($folder_path)) {
            File::makeDirectory($folder_path, 0777, true, true);
        }

        return  "check";



        return dd(request()->getClientIp());

        phpinfo();
    } //end of method test




    protected function getAdminPermissionsCanTake(): array
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
} //end of class
