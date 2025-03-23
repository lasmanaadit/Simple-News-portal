<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\News;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password')
        ]);

        $category = Category::create(['name' => 'Pendidikan']);
        News::create([
            'title' => 'Berita Pendidikan terbaru',
            'slug' => 'berita-pendidikan-terbaru',
            'content' => 'ini adalah berita pendidikan terbaru',
            'image' => 'news1.jpg',
            'user_id' => $admin->id,
            'category_id' => $category->id
        ]);
    }
}
