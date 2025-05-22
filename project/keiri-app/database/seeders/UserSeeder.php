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
        // ID: 2
        $manager1 = new User();
        $manager1->department_id = 1;
        $manager1->job_position = 'PS_PM';
        $manager1->full_name = 'Nguyen Tien Dung';
        $manager1->email = 'dungnt@test.com';
        $manager1->password = Hash::make('12345678');
        $manager1->role = UserRole::Manager;
        $manager1->job_position = 'PM';
        $manager1->save();

        // ID: 3
        $manager2 = new User();
        $manager2->department_id = 1;
        $manager2->job_position = 'PL';
        $manager2->full_name = 'Kieu Bao Long';
        $manager2->email = 'longkl@test.com';
        $manager2->password = Hash::make('12345678');
        $manager2->role = UserRole::Manager;
        $manager2->job_position = 'PM';
        $manager2->save();

        // ID: 4
        $manager3 = new User();
        $manager3->department_id = 1;
        $manager2->job_position = 'PL';
        $manager3->full_name = 'Tran Tuan Long';
        $manager3->email = 'longtl@test.com';
        $manager3->password = Hash::make('12345678');
        $manager3->role = UserRole::Manager;
        $manager3->job_position = 'PM';
        $manager3->save();

        // ID: 5
        $manager4 = new User();
        $manager4->department_id = 1;
        $manager4->full_name = 'Manager';
        $manager4->email = 'manager@test.com';
        $manager4->password = Hash::make('12345678');
        $manager4->role = UserRole::Manager;
        $manager4->job_position = 'PM';
        $manager4->save();

        /* Employee. */
        // ID: 6
        $employee6 = new User();
        $employee6->department_id = 1;
        $employee6->full_name = 'employee';
        $employee6->email = 'employee@test.com';
        $employee6->password = Hash::make('12345678');
        $employee6->role = UserRole::Employee;
        $employee6->save();

        // ID: 7
        $employee7 = new User();
        $employee7->department_id = 1;
        $employee7->job_position = 'PS_PG';
        $employee7->full_name = 'Tran Phuc Hong';
        $employee7->email = 'hongtp@test.com';
        $employee7->password = Hash::make('12345678');
        $employee7->role = UserRole::Employee;
        $employee7->save();

        // ID: 8
        $employee8 = new User();
        $employee8->department_id = 1;
        $employee8->job_position = 'SE';
        $employee8->full_name = 'Nguyen Minh Vu';
        $employee8->email = 'vunm@test.com';
        $employee8->password = Hash::make('12345678');
        $employee8->role = UserRole::Employee;
        $employee8->save();

        // ID: 9
        $employee9 = new User();
        $employee9->department_id = 1;
        $employee9->job_position = 'SE';
        $employee9->full_name = 'Bui Thi Thom';
        $employee9->email = 'thombt@test.com';
        $employee9->password = Hash::make('12345678');
        $employee9->role = UserRole::Employee;
        $employee9->save();

        // ID: 10
        $employee10 = new User();
        $employee10->department_id = 1;
        $employee10->job_position = 'SE';
        $employee10->full_name = 'Nguyen Thanh Minh';
        $employee10->email = 'minhnt@test.com';
        $employee10->password = Hash::make('12345678');
        $employee10->role = UserRole::Employee;
        $employee10->save();

        // ID: 11
        $employee11 = new User();
        $employee11->department_id = 1;
        $employee11->job_position = 'PS_SE';
        $employee11->full_name = 'Nguyen Tien Trung';
        $employee11->email = 'trungnt11@test.com';
        $employee11->password = Hash::make('12345678');
        $employee11->role = UserRole::Employee;
        $employee11->save();

        // ID: 12
        $employee12 = new User();
        $employee12->department_id = 1;
        $employee12->job_position = 'PS_SE';
        $employee12->full_name = 'Nguyen Anh Tuan';
        $employee12->email = 'tuanna@test.com';
        $employee12->password = Hash::make('12345678');
        $employee12->role = UserRole::Employee;
        $employee12->save();

        // ID: 13
        $employee13 = new User();
        $employee13->department_id = 1;
        $employee13->job_position = 'SE';
        $employee13->full_name = 'Nguyen Thanh Trung';
        $employee13->email = 'trungnt13@test.com';
        $employee13->password = Hash::make('12345678');
        $employee13->role = UserRole::Employee;
        $employee13->save();

        // ID: 14
        $employee14 = new User();
        $employee14->department_id = 1;
        $employee14->job_position = 'SE';
        $employee14->full_name = 'Pham Long Quan';
        $employee14->email = 'quanpl@test.com';
        $employee14->password = Hash::make('12345678');
        $employee14->role = UserRole::Employee;
        $employee14->save();

        // ID: 15
        $employee15 = new User();
        $employee15->department_id = 1;
        $employee15->job_position = 'SE';
        $employee15->full_name = 'Do Tuan Thanh';
        $employee15->email = 'thanhdt@test.com';
        $employee15->password = Hash::make('12345678');
        $employee15->role = UserRole::Employee;
        $employee15->save();

        // ID: 16
        $employee16 = new User();
        $employee16->department_id = 1;
        $employee16->job_position = 'SE';
        $employee16->full_name = 'Bui Hong Khanh';
        $employee16->email = 'khanhbh@test.com';
        $employee16->password = Hash::make('12345678');
        $employee16->role = UserRole::Employee;
        $employee16->save();

        // ID: 17
        $employee17 = new User();
        $employee17->department_id = 1;
        $employee17->job_position = 'PG';
        $employee17->full_name = 'Nguyen Hai Anh';
        $employee17->email = 'anhnh@test.com';
        $employee17->password = Hash::make('12345678');
        $employee17->role = UserRole::Employee;
        $employee17->save();

        // ID: 18
        $employee18 = new User();
        $employee18->department_id = 1;
        $employee18->job_position = 'PG';
        $employee18->full_name = 'Hoang Quang Linh';
        $employee18->email = 'linhhq@test.com';
        $employee18->password = Hash::make('12345678');
        $employee18->role = UserRole::Employee;
        $employee18->save();

        // ID: 19
        $employee19 = new User();
        $employee19->department_id = 1;
        $employee19->job_position = 'PG';
        $employee19->full_name = 'Luu Thi Hai Yen';
        $employee19->email = 'yenlth@test.com';
        $employee19->password = Hash::make('12345678');
        $employee19->role = UserRole::Employee;
        $employee19->save();

        // ID: 20
        $employee20 = new User();
        $employee20->department_id = 1;
        $employee20->job_position = 'PG';
        $employee20->full_name = 'Nguyen Tuan Anh';
        $employee20->email = 'anhnt@test.com';
        $employee20->password = Hash::make('12345678');
        $employee20->role = UserRole::Employee;
        $employee20->save();

        // ID: 21
        $employee21 = new User();
        $employee21->department_id = 1;
        $employee21->job_position = 'PS_PG';
        $employee21->full_name = 'Pham Van Dat';
        $employee21->email = 'datpv@test.com';
        $employee21->password = Hash::make('12345678');
        $employee21->role = UserRole::Employee;
        $employee21->save();

        // ID: 22
        $employee22 = new User();
        $employee22->department_id = 1;
        $employee22->job_position = 'PG';
        $employee22->full_name = 'Tran Anh Duc';
        $employee22->email = 'ducta@test.com';
        $employee22->password = Hash::make('12345678');
        $employee22->role = UserRole::Employee;
        $employee22->save();

        // ID: 23
        $employee23 = new User();
        $employee23->department_id = 1;
        $employee23->job_position = 'PG';
        $employee23->full_name = 'Nguyen Xuan Truong';
        $employee23->email = 'truongnx@test.com';
        $employee23->password = Hash::make('12345678');
        $employee23->role = UserRole::Employee;
        $employee23->save();

        // ID: 24
        $employee24 = new User();
        $employee24->department_id = 1;
        $employee24->job_position = 'PS_PL';
        $employee24->full_name = 'Nguyen Minh Quang';
        $employee24->email = 'anhnm@test.com';
        $employee24->password = Hash::make('12345678');
        $employee24->role = UserRole::Employee;
        $employee24->save();

        // ID: 25
        $employee25 = new User();
        $employee25->department_id = 1;
        $employee25->job_position = 'CM';
        $employee25->full_name = 'Nguyen Thi Ngoc Anh';
        $employee25->email = 'anhntn@test.com';
        $employee25->password = Hash::make('12345678');
        $employee25->role = UserRole::Employee;
        $employee25->save();

        // ID: 26
        $employee26 = new User();
        $employee26->department_id = 1;
        $employee25->job_position = 'CM';
        $employee26->full_name = 'Tran Minh Hang';
        $employee26->email = 'hangtm@test.com';
        $employee26->password = Hash::make('12345678');
        $employee26->role = UserRole::Employee;
        $employee26->save();

        // ID: 27
        $employee27 = new User();
        $employee27->department_id = 1;
        $employee27->job_position = 'CM';
        $employee27->full_name = 'Hoang Thi Ngoc Dung';
        $employee27->email = 'dunghtn@test.com';
        $employee27->password = Hash::make('12345678');
        $employee27->role = UserRole::Employee;
        $employee27->save();
    }
}
