<?php

namespace App\Console\Commands;

use App\Models\CheckInOut;
use Illuminate\Console\Command;
use App\Models\User;
use App\Models\LeaveDays;
use App\Models\LeaveDaysLog;
use App\Models\ApplicationForm;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DayOffHistoryByMonth extends Command
{
    protected $signature = 'leave-days:update-day-off-log';
    protected $description = 'Update leave days log for users with role 1, 2'; //user and mod

    public function handle()
    {
        try {
            // Get all users with role 1
//            $users = User::where('role', 1)->get();
            $users = User::whereIn('role', [1, 2])->get();

            $currentDate = now();
            $previousDate = now()->startOfMonth()->subMonth();

            $startOfMonth = $currentDate->copy()->startOfMonth()->format('Y-m-d');
            $endOfMonth = $currentDate->copy()->endOfMonth()->format('Y-m-d');

            foreach ($users as $user) {
                // Get leave days data for user
                $leaveDays = LeaveDays::where('user_id', $user->id)->first();

                if (!$leaveDays) {
                    continue;
                }

                // Get previous month's log
                $previousLog = null;
                if ($previousDate->month == 12) {
                    $previousLog = LeaveDaysLog::where('user_id', $user->id)
//                    ->whereMonth('date', Carbon::now()->subMonth()->month)
                        ->whereYear('date', $previousDate->year)
                        ->whereMonth('date', $previousDate->month)
                        ->first();
                }

                // Calculate totals from application_form for current month
                $plToUsedM = ApplicationForm::where('user_id', $user->id)
                    ->where('leave_type', 1)
                    ->where('verify_status', true)
                    ->whereBetween('start_date', [$startOfMonth, $endOfMonth])
                    ->whereBetween('end_date', [$startOfMonth, $endOfMonth])
                    ->sum('total_hours');

                $plToUsedMM_Auto = CheckInOut::where('user_id', $user->id)
                    ->where('leave_type', 1)
                    ->where('auto_add', true)
                    ->whereBetween('date', [$startOfMonth, $endOfMonth])
                    ->sum('working_time');

                $planPlToUsedM = ApplicationForm::where('user_id', $user->id)
                    ->where('leave_type', 6)
                    ->where('verify_status', true)
                    ->whereBetween('start_date', [$startOfMonth, $endOfMonth])
                    ->whereBetween('end_date', [$startOfMonth, $endOfMonth])
                    ->sum('total_hours');

                $plInAdvanceToUsedM = ApplicationForm::where('user_id', $user->id)
                    ->where('leave_type', 3)
                    ->where('verify_status', true)
                    ->whereBetween('start_date', [$startOfMonth, $endOfMonth])
                    ->whereBetween('end_date', [$startOfMonth, $endOfMonth])
                    ->sum('total_hours');

                $unPlToUsedM = ApplicationForm::where('user_id', $user->id)
                    ->where('leave_type', 2)
                    ->where('verify_status', true)
                    ->whereBetween('start_date', [$startOfMonth, $endOfMonth])
                    ->whereBetween('end_date', [$startOfMonth, $endOfMonth])
                    ->sum('total_hours');

                $slToUsedM = ApplicationForm::where('user_id', $user->id)
                    ->whereIn('leave_type', [5, 7])
                    ->where('verify_status', true)
                    ->whereBetween('start_date', [$startOfMonth, $endOfMonth])
                    ->whereBetween('end_date', [$startOfMonth, $endOfMonth])
                    ->sum('total_hours');

                $compensatoryDayToUsedM = ApplicationForm::where('user_id', $user->id)
                    ->where('leave_type', 4)
                    ->where('verify_status', true)
                    ->whereBetween('start_date', [$startOfMonth, $endOfMonth])
                    ->whereBetween('end_date', [$startOfMonth, $endOfMonth])
                    ->sum('total_hours');

                $plToUsedM = $plToUsedM+$plToUsedMM_Auto == 0 ? 0 : ($plToUsedM+$plToUsedMM_Auto / 8);
                $planPlToUsedM = $planPlToUsedM == 0 ? 0 : ($planPlToUsedM / 8);
                $plInAdvanceToUsedM = $plInAdvanceToUsedM == 0 ? 0 : ($plInAdvanceToUsedM / 8);
                $unPlToUsedM = $unPlToUsedM == 0 ? 0 : ($unPlToUsedM / 8);
                $slToUsedM = $slToUsedM == 0 ? 0 : ($slToUsedM / 8);
                $compensatoryDayToUsedM = $compensatoryDayToUsedM == 0 ? 0 : ($compensatoryDayToUsedM / 8);

                // Calculate all_pl_use_m (K = N + B + C + 1)
                $allPlUseM = $leaveDays->compensatory_day_off +
                    $leaveDays->carried_days_off +
                    $leaveDays->award_days_off +
                    1;

                // Get previous all_pl_to_used_m or default to 0
                $previousAllPlToUsed = $previousLog ? $previousLog->all_pl_to_used_m : 0;

                // Calculate all_pl_to_used_m (L = previous_L + E + F + G + J)
                $allPlToUsedM = $previousAllPlToUsed +
                    $plToUsedM +
                    $planPlToUsedM +
                    $plInAdvanceToUsedM +
                    $compensatoryDayToUsedM;

                // Calculate remaining (M = K - L)
                $remainingPl = $allPlUseM - $allPlToUsedM;

                $this->info("NGƯỜI DÙNG VỚI USER_ID LÀ: {$user->id}");
                $this->info("NGÀY BẮT ĐẦU THÁNG {$startOfMonth} *** NGÀY KẾT THÚC THÁNG {$endOfMonth}");
                $this->info("PAIDLEAVE ĐÃ DÙNG {$plToUsedM}");
                $this->info("NGÀY CHẠY SCRIPT NÀY {$currentDate->format('Y-m-d')}");
                // Create or update leave days log
                LeaveDaysLog::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'date' => $currentDate->format('Y-m-d')
                    ],
                    [
                        'days_off_in_advance' => $leaveDays->days_off_in_advance,
                        'days_off' => $leaveDays->days_off,
                        'award_days_off' => $leaveDays->award_days_off,
                        'days_off_to_june' => $leaveDays->days_off_to_june,
                        'compensatory_day_off' => $leaveDays->compensatory_day_off,
                        'carried_days_off' => $leaveDays->carried_days_off,
                        'days_off_to_used' => $leaveDays->days_off_to_used,
                        'days_off_in_advance_to_used' => $leaveDays->days_off_in_advance_to_used,
                        'pl_to_used_m' => $plToUsedM,
                        'plan_pl_to_used_m' => $planPlToUsedM,
                        'pl_in_advance_to_used_m' => $plInAdvanceToUsedM,
                        'un_pl_to_used_m' => $unPlToUsedM,
                        'sl_to_used_m' => $slToUsedM,
                        'compensatory_day_to_used_m' => $compensatoryDayToUsedM,
                        'all_pl_available_m' => $allPlUseM,
                        'all_pl_to_used_m' => $allPlToUsedM,
                        'all_pl_remain_to_use_m' => $remainingPl
                    ]
                );
            }

            $this->info('Leave days log updated successfully!');
        } catch (\Exception $e) {
            $this->error('Error updating leave days log: ' . $e->getMessage());
//            \Log::error('Leave days log update error: ' . $e->getMessage());
        }
    }
}
