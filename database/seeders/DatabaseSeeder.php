<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Ayo Belajar',
            'email' => 'belajar@example.com',
            'password' => bcrypt('password'),
        ]);

        Product::factory(20)->create();
        Category::factory(10)->create();
    }
}
