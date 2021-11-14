<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class TestControler extends Controller
{


    public function test()
    {


        $admin =Admin::where('name','yosef')->first();
        $admin_permissions = $admin->permissions->pluck('name')->toArray(); //25

        $permissions_can = $this->getAdminPermissionsCanTake(); //32

        $role_permissions = Role::findByName('category','admin')->permissions->pluck('name')->toArray();

        // return count($admin_permissions);


        $the_diffrent =  array_values(array_diff($permissions_can,$admin_permissions));


        return count(array_intersect($admin_permissions,$role_permissions)) == count($role_permissions);


        return count(array_intersect($role_permissions,$admin_permissions)) == count($admin_permissions);


        return $the_diffrent;


        return admin()->roles()->pluck('name');

    } //end of method test




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





} //end of class
