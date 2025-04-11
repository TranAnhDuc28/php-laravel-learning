<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
        ]);

        for ($i = 1; $i < 10; $i++) {
            Post::query()->create([
               'title' => fake()->text()
            ]);
        }

        for ($i = 1; $i < 100; $i++) {
            Comment::query()->create([
                'post_id' => rand(1, 10),
                'message' => fake()->text()
            ]);
        }

        // User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);
    }
}
