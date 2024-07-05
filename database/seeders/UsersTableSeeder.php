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
     */
    public function run(): void
    {
        DB::table('users')->insert([
            //admin
            [
                'name' =>  'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123123123'),
                'role' => 'admin',
            ],

            //agent
            [
                'name' =>  'Staff',
                'email' => 'staff@gmail.com',
                'password' => Hash::make('123123123'),
                'role' => 'staff',
            ],
        ]);
    }
}
