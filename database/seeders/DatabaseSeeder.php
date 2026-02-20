<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Image;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        
        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin')
        ]);

        Category::factory(50)->create();
        Image::factory(50)->create();
        User::factory(50)->create();
    }
}
