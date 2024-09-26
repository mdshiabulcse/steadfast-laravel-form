<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organizations')->insert([
            ['name' => 'Southeast University' ],
            ['name' => 'Rajshahi Polytechnic Institute'],
            ['name' => 'Dhaka Polytechnic Institute'],
            ['name' => 'Rangpur Polytechnic Institute'],
        ]);
    }
}
