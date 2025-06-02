<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role_permissions')->insert([
            ['user_role_id' => '1',
             'permission_id' => '2'],
             ['user_role_id' => '2',
             'permission_id' => '2'],
             ['user_role_id' => '1',
             'permission_id' => '3'],
             ['user_role_id' => '2',
             'permission_id' => '3'],
             ['user_role_id' => '1',
             'permission_id' => '4'],
             ['user_role_id' => '2',
             'permission_id' => '4'],
        ]);
    }
}
