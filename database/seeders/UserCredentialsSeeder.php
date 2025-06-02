<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UserCredentialsSeeder extends Seeder
{
    public function run()
    {
        DB::table('login_credentials')->insert([
            'employee_id' => '1',
            'username' => 'newuser',
            'password' => Hash::make('password123'), // Bcrypt-hashed password
            'user_role_id' => "1",
        ]);
    }
}
