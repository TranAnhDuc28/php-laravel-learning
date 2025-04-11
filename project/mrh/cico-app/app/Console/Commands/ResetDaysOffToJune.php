<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\LeaveDays;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

// ******************************************************
// command chạy ngày 1 tháng 6
// xoá toàn bộ phép dư của năm ngoái

class ResetDaysOffToJune extends Command
{
    protected $signature = 'leave:reset-days-off-to-june';
    protected $description = 'Reset days_off_to_june to 0 for all records with current year';

    public function handle()
    {
        $currentYear = now()->year;

        LeaveDays::where('year', $currentYear)
            ->update(['days_off_to_june' => 0]);

//        DB::table('leave_days')
//            ->where('year', $currentYear)
//            ->update(['days_off_to_june' => 0]);

        $this->info("Reset days_off_to_june to 0 for all records with current year {$currentYear}");
    }
}
