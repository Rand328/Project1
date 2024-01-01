<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add default admin
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@ehb.be',
            'password' => Hash::make('Password!321'),
            'role' => 'admin',
            'birthday' => '2000-01-01', 
            'about_me' => 'This is the admin user.', 
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // You can add more seed data if needed
    }
}

