<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tag;
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
        for ($i = 0; $i < 10; $i++) {
            Category::query()->create([
                'name' => 'Category' . $i
            ]);
        }

        for ($i = 0; $i < 10; $i++) {
            Tag::query()->create([
                'name' => 'Tag' . $i
            ]);
        }
    }
}
