<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
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
        // ID: 1
        $adminTest = new User();
        $adminTest->department_id = 1;
        $adminTest->full_name = 'Admin';
        $adminTest->email = 'admin@test.com';
        $adminTest->password = Hash::make('12345678');
        $adminTest->role = UserRole::ADMIN;
        $adminTest->save();
    }
}
