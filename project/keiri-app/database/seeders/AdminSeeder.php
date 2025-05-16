<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* Create Admin. */
        $admin = new User();
        $admin->department_id = 1;
        $admin->full_name = 'Admin';
        $admin->email = 'admin@test.com';
        $admin->password = Hash::make('12345678');
        $admin->role = UserRole::Admin;
        $admin->save();
    }
}
