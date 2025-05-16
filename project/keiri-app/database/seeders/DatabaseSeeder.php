<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            /* Department. */
            DepartmentSeeder::class,

            /* System Admin. */
            AdminSeeder::class,

            /* Manager, User. */
            UserSeeder::class,
        ]);
    }
}
