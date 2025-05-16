<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Department;
use App\Models\User;
use Carbon\Carbon;
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
