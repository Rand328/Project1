<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            // Seed default admin
            AdminSeeder::class,
            // Seed 2 posts
            PostSeeder::class,
            // Seed FAQ categories and questions
            FaqSeeder::class,
        ]);
        
        // Seed dummy users: 2 with role admin, 10 with role user 
        User::factory(2)->create([
            'role' => 'admin',
            'birthday' => '2000-01-01', 
            'about_me' => 'This is an admin user.',
        ]);
        
        User::factory(10)->create();

    }
}
