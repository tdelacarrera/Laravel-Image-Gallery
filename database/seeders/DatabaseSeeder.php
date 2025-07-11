<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Image;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
           Image::factory(50)->create();
           User::factory(50)->create();
    }
}
