<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CheckInOut;

class CheckInOutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CheckInOut::factory()->count(11)->create();
    }
}
