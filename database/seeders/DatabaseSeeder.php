<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $default_image = 'default.png';
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \DB::table('brands')->insert([
            ['nameBrand' => 'Indofood', 'image' => $default_image],
            ['nameBrand' => 'ABC', 'image' => $default_image],
            ['nameBrand' => 'Mayora', 'image' => $default_image],
            ['nameBrand' => 'Sayap Mas Utama', 'image' => $default_image],
        ]);

        // Categories
        \DB::table('categories')->insert([
            ['nameCategory' => 'Makanan'],
            ['nameCategory' => 'Minuman'],
            ['nameCategory' => 'Sembako'],
            ['nameCategory' => 'Rokok'],
            ['nameCategory' => 'Pakaian'],
        ]);
    }
}
