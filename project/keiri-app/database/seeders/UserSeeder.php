<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* Manager. */
        $admin = new User();
        $admin->department_id = 1;
        $admin->full_name = 'Manager1';
        $admin->email = 'manager1@test.com';
        $admin->password = Hash::make('12345678');
        $admin->role = UserRole::Manager;
        $admin->job_position = 'PM';
        $admin->save();

        $admin = new User();
        $admin->department_id = 1;
        $admin->full_name = 'Manager2';
        $admin->email = 'manager2@test.com';
        $admin->password = Hash::make('12345678');
        $admin->role = UserRole::Manager;
        $admin->job_position = 'PM';
        $admin->save();

        /* Employee. */
        $admin = new User();
        $admin->department_id = 1;
        $admin->full_name = 'Employee1';
        $admin->email = 'employee1@test.com';
        $admin->password = Hash::make('12345678');
        $admin->role = UserRole::Employee;
        $admin->save();

        $admin = new User();
        $admin->department_id = 1;
        $admin->full_name = 'Employee2';
        $admin->email = 'employee2@test.com';
        $admin->password = Hash::make('12345678');
        $admin->role = UserRole::Employee;
        $admin->save();

        User::factory(20)->create();
    }
}
