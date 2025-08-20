<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kaedah 1 - Query Builder
        DB::table('users')->insert([
            'name' => 'Ahmad Albab',
            'email' => 'ahmadalbab@gmail.com',
            'password' => bcrypt('password'),
            'phone' => '0123456789',
            'status' => 'active',
            'created_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Siti Sifir',
            'email' => 'sitisifir@gmail.com',
            'password' => bcrypt('password'),
            'phone' => '0123456789',
            'status' => 'active',
            'created_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Muhammad',
            'email' => 'muhammad@gmail.com',
            'password' => bcrypt('password'),
            'phone' => '0123456789',
            'status' => 'active',
            'created_at' => now()
        ]);

        // Kaedah 2 - ORM / Model
        // User::create();
        // $user = new User();
    }
}
