<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin =  Admin::create(['name' => 'ahmed', 'email' => 'a@a.com', 'password' => bcrypt(123456789)]);
        $admin =  Admin::create(['name' => 'admin 1', 'email' => 'ad@ad.com', 'password' => bcrypt(123456789)]);

        $role_super = Role::create(['guard_name' => 'admin', 'name' => 'super_admin']);
        $role_admin = Role::create(['guard_name' => 'admin', 'name' => 'admin']);
        // $permission = Permission::create(['name' => 'edit articles']);

        //$role->givePermissionTo($permission);

        $super_admin->assignRole($role_super);
        $admin->assignRole($role_admin);
    }
}
