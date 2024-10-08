<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_roles')->insert([
            ['role' => 'admin', 'role_description' => 'Admin'],
            ['role' => 'user', 'role_description' => 'User'],
        ]);
    }
}
