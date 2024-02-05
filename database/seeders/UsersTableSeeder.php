<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'role_id'=>'1',
            'name'=>'Admin',
           'phone'=>'1234567890',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('password'),
        ]);

        DB::table('users')->insert([
            'role_id'=>'2',
            'name'=>'User',
            'phone'=>'1234567890',
            'email'=>'user@gmail.com',
            'password'=>bcrypt('password'),
        ]);
    }
}
