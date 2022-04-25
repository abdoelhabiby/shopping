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
        // Admin::truncate();
        // Role::truncate();
        // Permission::truncate();

        try {


            DB::beginTransaction();



            $super_admin =  Admin::create(['name' => 'kartal', 'email' => 'a@a.com', 'password' => bcrypt(123456789)]);
            $admin =  Admin::create(['name' => 'admin 1', 'email' => 'ad@ad.com', 'password' => bcrypt(123456789)]);


            DB::commit();

            return $this->command->info('success create roles and permissions');
        } catch (\Throwable $th) {
            DB::rollback();

            return $this->command->error($th->getMessage());
        } //end of try


    }
}
