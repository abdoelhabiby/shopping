<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminsRolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::beginTransaction();

            $admin = Admin::where('email', 'a@a.com')->first();

            $role_super_admin = Role::firstOrCreate(
                ['name' => 'super_admin'],
                ['guard_name' => 'admin']
            );

            $permissions = Permission::pluck('name');
            $role_super_admin->syncPermissions($permissions);
            $admin->assignRole($role_super_admin->name);


            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            $this->command->error($th->getMessage() . 'error');

            return false;
        }
    }
}
