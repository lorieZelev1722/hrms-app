<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PermissionsListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permission_list')->insert([
            ['permission_name' => 'Dashboard'],
            ['permission_name' => 'Employee List'],
            ['permission_name' => 'Hours and Leave List']
        ]);
    }
}
