<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $it = new Department();
        $it->name = 'IT';
        $it->save();

        $it = new Department();
        $it->name = 'Hành chính - Nhân sự';
        $it->save();
    }
}
