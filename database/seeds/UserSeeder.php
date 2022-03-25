<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        User::firstOrCreate(['name' => 'mohamed','email' => 'm@m.com','password' => bcrypt(123456789)]);
    }
}
