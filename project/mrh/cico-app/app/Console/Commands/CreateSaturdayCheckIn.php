<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\CheckInOut;
use Illuminate\Console\Command;
use Carbon\Carbon;

class CreateSaturdayCheckIn extends Command
{
    protected $signature = 'checkin:create-saturday-daily';
    protected $description = 'Create saturday check in records for users with role 1 and 2';

    public function handle()
    {
        // Lấy danh sách user có role 1 và 2
        $users = User::whereIn('role', [1, 2])->get();

        // Lấy ngày hiện tại với format YYYYMMDD
        $today = Carbon::now()->format('Y-m-d');

        foreach ($users as $user) {
            // Kiểm tra xem đã có bản ghi cho user này trong ngày hôm nay chưa
            $checkInOut = CheckInOut::firstOrNew([
                'user_id' => $user->id,
                'date' => $today,
                'check_in' => '00:00:00',
            ]);

            if (empty($checkInOut->check_in)) {
                $checkInOut->check_in = '00:00:00';
            }

            if (empty($checkInOut->check_out)) {
                $checkInOut->check_out = '00:00:00';
            }

            $checkInOut->in_lack_time = 0;
            $checkInOut->out_lack_time = 0;
            $checkInOut->working_time = 8;
            $checkInOut->official_working_hours = 8;

            // Lưu bản ghi
            $checkInOut->save();
        }

        $this->info('Saturday check-in records have been created/updated successfully!');
    }
}
