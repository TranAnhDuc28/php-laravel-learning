<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use App\Models\CheckInOut;
use App\Models\DaysOffBySchedule;
use Illuminate\Console\Command;

class AutoCheckInOutByDayOffPlannedCommand extends Command
{
    protected $signature = 'checkin:auto-create-by-day-off-planned';
    protected $description = 'Automatically create check-in/out records based on days_off_by_schedule';

    public function handle()
    {
        $this->info('Starting automatic check-in/out creation...');

        // Get users with roles 1 and 2
        $users = User::whereIn('role', [1, 2])->get();

        // Get current year's days off
        $currentYear = Carbon::now()->year;
        $daysOff = DaysOffBySchedule::whereYear('start_date', $currentYear)
            ->where('leave_type', 5)->get();

        $createdRecords = 0;

        foreach ($daysOff as $dayOff) {
            $startDate = Carbon::parse($dayOff->start_date);
            $endDate = Carbon::parse($dayOff->end_date);
            $dateRange = [];

            // Generate date range between start_date and end_date
            for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                // Skip Sundays (Carbon treats Sunday as 0)
                if ($date->dayOfWeek !== 0 && $date->dayOfWeek !== 6) {
                    $dateRange[] = $date->format('Y-m-d');
                }
            }

            // Create check-in/out records for each user and date
            foreach ($users as $user) {
                foreach ($dateRange as $date) {
                    $checkInOut = CheckInOut::firstOrNew([
                        'user_id' => $user->id,
                        'date' => $date,
                    ]);

                    // Only proceed if the record doesn't exist or check_in is empty
                    if (!$checkInOut->exists || empty($checkInOut->check_in)) {
                        $checkInOut->check_in = '00:00:00';
                        $checkInOut->check_out = '00:00:00';
                        $checkInOut->in_lack_time = 0;
                        $checkInOut->out_lack_time = 0;
                        $checkInOut->working_time = 8;
                        $checkInOut->official_working_hours = 8;
                        $checkInOut->auto_add = true;
                        $checkInOut->leave_type = $dayOff->leave_type;

                        $checkInOut->save();
                        $createdRecords++;
                    }
                }
            }
        }

        $this->info("Completed! Created {$createdRecords} check-in/out records.");
    }
}
