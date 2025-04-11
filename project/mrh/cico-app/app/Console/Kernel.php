<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        // Định nghĩa lịch trình ở đây
        // Ví dụ: chạy lệnh mỗi phút
        // $schedule->command('your:command')->everyMinute();

        $schedule->command('leave:add-days-off-new-year')
                ->yearly()
                ->at('00:01'); // Chạy vào 1 phút đầu tiên của năm mới
        $schedule->command('leave:reset-days-off-to-june')
                ->yearly()
                ->monthlyOn(6, 1) // Chạy vào ngày 1 tháng 6
                ->at('00:01'); // Chạy vào 1 phút đầu tiên của ngày 1 tháng 6

            //TODO: testing schedule
        $schedule->command('leave:reset-days-off-to-june')
                ->daily()
                ->at('15:35');

    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        // Đăng ký các lệnh Artisan mặc định
        require base_path('routes/console.php');
    }
}
