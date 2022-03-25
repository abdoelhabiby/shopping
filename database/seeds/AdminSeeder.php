<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        Admin::truncate();
        Role::truncate();
        Permission::truncate();

        try {


            DB::beginTransaction();



            $super_admin =  Admin::create(['name' => 'kartal', 'email' => 'a@a.com', 'password' => bcrypt(123456789)]);
            $admin =  Admin::create(['name' => 'admin 1', 'email' => 'ad@ad.com', 'password' => bcrypt(123456789)]);

            //check role super admin

            $check_role_super_admin = Role::where(['name' => 'super_admin', 'guard_name' => 'admin'])->first();


            if (!$check_role_super_admin) {

                $role_super_admin = Role::create(['name' => 'super_admin', 'guard_name' => 'admin']);
                // $super_admin->assignRole($role_super_admin->name);

            }

            $roles = config('permission.roles_oshastore');
            $permissions_map = config('permission.permissions_map_oshastore');

            // first create roles

            foreach ($roles as $role) {

                $check_role = Role::where(['name' => $role, 'guard_name' => 'admin'])->first();


                if (!$check_role) {

                    $new_role = Role::create(['name' => $role, 'guard_name' => 'admin']);

                    // create permissions and give permisions to role

                    foreach ($permissions_map as $permission_map) {

                        $check_permission = Permission::where(['name' => $permission_map, 'guard_name' => 'admin'])->first();

                        if (!$check_permission) {

                            $permission = Permission::create(['name' => $permission_map . '_' . $new_role->name, 'guard_name' => 'admin']);

                            $new_role->givePermissionTo($permission->name);
                        }
                    }
                }
            }





            $get_all_roles = Role::all()->pluck('name');


            $super_admin->syncRoles($get_all_roles);



            DB::commit();

            return $this->command->info('success create roles and permissions');
        } catch (\Throwable $th) {
            DB::rollback();

            return $this->command->error($th->getMessage());
        } //end of try


    }
}
