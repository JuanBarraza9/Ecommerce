<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         
        DB::table('users')->insert([
            //Admin
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@correo.com',
                'password' => Hash::make('123123'),
                'role' => 'admin',
                'status' => 'active',
            ],
            //Vendor
            [
                'name' => 'Juan Vendor',
                'username' => 'vendor',
                'email' => 'vendor@correo.com',
                'password' => Hash::make('123123'),
                'role' => 'vendor',
                'status' => 'active',
            ],
            //User
            [
                'name' => 'User',
                'username' => 'user',
                'email' => 'user@correo.com',
                'password' => Hash::make('123123'),
                'role' => 'user',
                'status' => 'active',
            ],

        ]);
    }
}
