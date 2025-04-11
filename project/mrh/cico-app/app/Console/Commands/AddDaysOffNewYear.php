<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\LeaveDays;
use Carbon\Carbon;

// ******************************************************
// command chạy đầu năm
// tính số ngày phép đầu năm
// tính số ngày phép được ứng

class AddDaysOffNewYear extends Command
{
    protected $signature = 'leave:add-days-off-new-year';
    protected $description = 'Add leave days for employees at the beginning of new year';

    public function handle()
    {
        $this->info('Start add leave days for employees at the beginning of new year');
        $currentYear = now()->year;
        $users = User::whereIn('role', [1, 2])->get();

        foreach ($users as $user) {
            // Tính toán ngày nghỉ phép
            $joinDate = Carbon::parse($user->join_date);
            $monthsSinceJoin = floor($joinDate->diffInMonths(now()));
            $this->info("user id: {$user->id}");
            $this->info($monthsSinceJoin);
            // Tính days_off dùng để ứng phép (11 ngày nếu đã làm đủ 12 tháng)
            $daysOffInAdv = $monthsSinceJoin > 12 ? 11 : 0;

            // Tính award_days_off theo năm công tác
            $yearsSinceJoin = $joinDate->diffInYears(now());
            $awardDaysOff = (int)floor($yearsSinceJoin / 5);
//            $awardDaysOff = 0;
//            if ($yearsSinceJoin >= 5 && $yearsSinceJoin < 10) {
//                $awardDaysOff = 1;
//            } elseif ($yearsSinceJoin >= 10 && $yearsSinceJoin < 15) {
//                $awardDaysOff = 2;
//            } elseif ($yearsSinceJoin >= 15) {
//                $awardDaysOff = 3;
//            }

            // Tính days_off_to_june và carried_days_off
            $daysOffToJune = 0;
            $carried_days_off = 0;
            // Lấy bản ghi leave_days của năm trước
            $previousYearLeaveDays = LeaveDays::where('user_id', $user->id)
                ->where('year', $currentYear - 1)
                ->first();
            if (isset($previousYearLeaveDays)){
                // Tính days_off_to_june
                $daysOffToJune = ($previousYearLeaveDays->days_off ?? 0) +
                    ($previousYearLeaveDays->award_days_off ?? 0) +
                    ($previousYearLeaveDays->carried_days_off ?? 0);
                if ($monthsSinceJoin <= 12) {
                    if ($daysOffToJune < 3){
                        $carried_days_off = $daysOffToJune;
                    } else {
                        $carried_days_off = 3;
                        $daysOffToJune = $daysOffToJune - 3;
                    }
                }
            }

            $this->info('Start insert LeaveDays: '.$user->id);
            // Tạo bản ghi mới
            LeaveDays::create([
                'user_id' => $user->id,
                'days_off_in_advance' => $daysOffInAdv,
                'days_off' => 1, //TODO: set 0 to test; 1 to product
                'award_days_off' => $awardDaysOff,
                'carried_days_off' => $carried_days_off,
                'days_off_to_june' => $daysOffToJune,
                'year' => $currentYear
            ]);
            $this->info('End insert LeaveDays '.$user->id);
        }

        $this->info('Finish add leave days for employees at the beginning of new year');
    }
}
