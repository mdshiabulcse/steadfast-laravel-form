<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = DB::table('users')->insertGetId([
            'name' => 'User',
            'email' => 'user@mail.com',
            'password' => Hash::make('12345678'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $admin = DB::table('users')->insertGetId([
            'name' => 'Administrative',
            'email' => 'administrative@mail.com',
            'password' => Hash::make('12345678'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        DB::table('user_groups')->insert([
            ['user_id' => $user, 'user_role' => 1],
            ['user_id' => $admin, 'user_role' => 2],
        ]);
    }
}
