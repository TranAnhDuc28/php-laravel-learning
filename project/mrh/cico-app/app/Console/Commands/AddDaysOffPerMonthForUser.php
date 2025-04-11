<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\LeaveDays;
use Carbon\Carbon;

// ******************************************************
// command chạy đầu tháng (ngoại trừ tháng 1)
// tính toán lại phép ứng
// tính toán lại số ngày phép được hưởng

class AddDaysOffPerMonthForUser extends Command
{
    protected $signature = 'leave:add-days-off-per-month';
    protected $description = 'Add days off monthly for users';

    public function handle()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;
        if ($currentMonth != 1) {
            $this->info('Start add days off monthly for users');
            // Lấy danh sách user
            $users = User::whereIn('role', [1, 2])
                ->get();

            foreach ($users as $user) {
                $joinDate = Carbon::parse($user->join_date);
                $monthsSinceJoin = floor($joinDate->diffInMonths(now()));

//            LeaveDays::where('year', $currentYear, )
//                ->update(['days_off_to_june' => 0]);
                // Tìm hoặc tạo bản ghi leave_days cho năm hiện tại
                $leaveDays = LeaveDays::firstOrCreate(
                    [
                        'user_id' => $user->id,
                        'year' => $currentYear
                    ]
                );

                if($monthsSinceJoin == 13) {
                    $leaveDays->increment('award_days_off', 1);
                }

                // Tính toán days_off
                if ($leaveDays->days_off_in_advance_to_used > 0) {
                    $bonus = $leaveDays->days_off_in_advance_to_used - 1;
                    $this->info("user: {$user->id}");
                    $this->info("bonus: {$bonus}");
                    if ($bonus < 0) {
                        $leaveDays->decrement('days_off_in_advance', 1);
                        $leaveDays->increment('days_off', abs($bonus));
                        $leaveDays->increment('days_off_in_advance_to_used', $bonus);
                    } elseif ($bonus == 0) {
                        $leaveDays->decrement('days_off_in_advance_to_used', 1);
                        $leaveDays->decrement('days_off_in_advance', 1);
                    } elseif ($bonus > 0) {
                        $leaveDays->update([
                            'days_off_in_advance_to_used' => $bonus,
                        ]);
                        $leaveDays->decrement('days_off_in_advance', 1);
                    }

                    $this->info("User {$user->id}: Thêm 1 ngày phép");
                    $this->info("ngày phép được ứng đã sử dụng: {$leaveDays->days_off_in_advance_to_used}");
                    $this->info("ngày phép khả dụng: {$leaveDays->days_off}");
                } else {
                    if ($leaveDays->days_off_in_advance > 1) {
                        $leaveDays->decrement('days_off_in_advance', 1);
                        $leaveDays->increment('days_off', 1);
                    } else if ($leaveDays->days_off_in_advance == 0) {
                        $leaveDays->increment('days_off', 1);
                    } else if ($leaveDays->days_off_in_advance > 0 && $leaveDays->days_off_in_advance < 1) {
                        $leaveDays->increment('days_off', $leaveDays->days_off_in_advance);
                        $leaveDays->update([
                            'days_off_in_advance' => 0,
                        ]);
                    }

                    $this->info("User {$user->id}: Thêm 1 ngày phép");
                    $this->info("ngày phép được ứng khả dụng: {$leaveDays->days_off_in_advance}");
                    $this->info("ngày phép khả dụng: {$leaveDays->days_off}");
                }
            }
        }
        $this->info('Finish add days off monthly for users');
    }
}
