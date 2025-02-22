<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB; // Corrected the DB import
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Nayem Hassan',
                'email' => 'nayemhassan1111@gmail.com',
                'phone' => '01911118319',
                'designation' => 'Web Developer',
                'role' => 'admin',
                'status' => 'active', // Don't forget to add status field
                'password' => bcrypt('Diu123456#'),
            ],  [
                'name' => 'Shadhin',
                'email' => 'shadhin@gmail.com',
                'phone' => '01811',
                'role' => 'user',
                'status' => 'active', // Don't forget to add status field
                'password' => bcrypt('12345678'),
            ]
        ]);
    }
}
