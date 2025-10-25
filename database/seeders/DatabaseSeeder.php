<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Content;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        Content::factory(100)->create();

        // User Admin
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@admin.com',
            'password' => 'password',
            'role' => 'admin',
        ]);
    }
}
