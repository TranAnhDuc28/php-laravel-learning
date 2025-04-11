<?php

//declare(strict_types=1);

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\User;
use App\Models\CheckInOut;
use App\Constants\CommonConstants;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class CommonService
{
    public function calculateActualWorkingHour($check_in, $check_out)
    {
//        $resultWorkingTime = $this->commonService->calculateActualWorkingHour($checkInOut->check_in, $now->format('H:i'));
//        $check_in = "8:15";
//        $check_out = "17:00";

        $checkInTime = Carbon::createFromTimeString($check_in);
        $checkOutTime = Carbon::createFromTimeString($check_out);

        // Điều chỉnh check_in
        $adjustedCheckIn = $this->adjustCheckInTime($checkInTime);

        // Điều chỉnh check_out
        $adjustedCheckOut = $this->adjustCheckOutTime($checkOutTime);

        // Tính thời gian làm việc chính thức
        $officialWorkingTime = $this->calculateOfficialWorkingTime($adjustedCheckIn, $adjustedCheckOut);

        // Tính thời gian OT
        $overtimeHours = $this->calculateOvertimeHours($adjustedCheckOut);

        return [
            'official_working_hours' => $officialWorkingTime,
            'overtime_hours' => $overtimeHours,
            'total_working_hours' => $officialWorkingTime + $overtimeHours
        ];
    }

    private function adjustCheckInTime(Carbon $checkInTime)
    {
        // Nếu check_in trước 8:00, set về 8:00
        if ($checkInTime->lt(Carbon::createFromTimeString('08:00'))) {
            return Carbon::createFromTimeString('08:00');
        }

        // Xử lý các trường hợp check_in từ 8h đến 11h
        $hour = $checkInTime->hour;
        $minute = $checkInTime->minute;

        if (in_array($hour, [8, 9, 10, 11])) {
            if ($minute == 0) {
                return Carbon::createFromTimeString(sprintf('%d:00', $hour));
            } elseif ($minute >= 1 && $minute <= 30) {
                return Carbon::createFromTimeString(sprintf('%d:30', $hour));
            } else {
                return Carbon::createFromTimeString(sprintf('%d:00', $hour + 1));
            }
        }

        return $checkInTime;
    }

    private function adjustCheckOutTime(Carbon $checkOutTime)
    {
        // Xử lý check_out từ 17h đến 23h
        $hour = $checkOutTime->hour;
        $minute = $checkOutTime->minute;

        if ($hour == 12) {
            return Carbon::createFromTimeString('12:00');
        }

        if (in_array($hour, [8, 9, 10, 11, 13, 14, 15, 16])) {
            if ($minute < 30) {
                // Trường hợp mm < 15: về giờ trước đó :45
                return Carbon::createFromTimeString(sprintf('%d:00', $hour));
            } elseif ($minute >= 30 && $minute <= 59) {
                // Trường hợp 45 > mm >= 15: về giờ hiện tại :15
                return Carbon::createFromTimeString(sprintf('%d:30', $hour));
            }
        }

        if ($hour == 17) {
            return $minute < 45
                ? Carbon::createFromTimeString('17:00')
                : Carbon::createFromTimeString('17:45');
        }

        if (in_array($hour, [18, 19, 20, 21, 22, 23])) {
            if ($minute < 15) {
                // Trường hợp mm < 15: về giờ trước đó :45
                return Carbon::createFromTimeString(sprintf('%d:45', $hour - 1));
            } elseif ($minute >= 15 && $minute < 45) {
                // Trường hợp 45 > mm >= 15: về giờ hiện tại :15
                return Carbon::createFromTimeString(sprintf('%d:15', $hour));
            } else {
                // Trường hợp mm >= 45: về giờ hiện tại :45
                return Carbon::createFromTimeString(sprintf('%d:45', $hour));
            }
        }

        return $checkOutTime;
    }

    private function calculateOfficialWorkingTime(Carbon $checkIn, Carbon $checkOut)
    {
//        $lunchBreakStart = Carbon::createFromTimeString('12:00');
//        $lunchBreakEnd = Carbon::createFromTimeString('13:00');
//        $endWorkTime = Carbon::createFromTimeString('17:00');
//
//        // Loại bỏ thời gian nghỉ trưa
//        $officialWorkingTime = 0;
//
//        $currentTime = clone $checkIn;
//        while ($currentTime->lt($checkOut)) {
//            // Bỏ qua giờ nghỉ trưa
//            if ($currentTime->gte($lunchBreakStart) && $currentTime->lt($lunchBreakEnd)) {
//                $currentTime = clone $lunchBreakEnd;
//                continue;
//            }
//
//            // Dừng nếu vượt quá 17h
//            if ($currentTime->gte($endWorkTime)) {
//                break;
//            }
//
//            $officialWorkingTime += 0.5; // Tăng 30 phút mỗi lần
//            $currentTime->addMinutes(30);
//        }
        $startWorkTime = Carbon::createFromTimeString('08:00');
        $lunchBreakStart = Carbon::createFromTimeString('12:00');
        $lunchBreakEnd = Carbon::createFromTimeString('13:00');
        $endWorkTime = Carbon::createFromTimeString('17:00');

        // Nếu check out trước giờ làm việc, trả về 0
        if ($checkOut->lte($startWorkTime)) {
            return 0;
        }

        // Điểm bắt đầu tính giờ
        $startTime = max($checkIn, $startWorkTime);

        // Điểm kết thúc tính giờ
        $endTime = min($checkOut, $endWorkTime);

        // Loại trừ giờ nghỉ trưa
        if ($startTime->lt($lunchBreakStart) && $endTime->gt($lunchBreakStart)) {
            $endTime = $endTime->gt($lunchBreakEnd)
                ? $endTime->subHours(1)
                : $lunchBreakStart;
        }

        // Tính số phút làm việc
        $minutesWorked = $startTime->diffInMinutes($endTime);

        // Chuyển đổi sang giờ với độ chính xác 0.5
        $officialWorkingTime = ceil($minutesWorked / 30) / 2;

        return $officialWorkingTime;
    }

    private function calculateOvertimeHours(Carbon $checkOut)
    {
        $startOTTime = Carbon::createFromTimeString('17:15');
        $breakOTStart = Carbon::createFromTimeString('19:15');
        $breakOTEnd = Carbon::createFromTimeString('20:15');
        $endOTTime = Carbon::createFromTimeString('23:15');

        // Không tính OT nếu check_out trước 17:15
        if ($checkOut->lt($startOTTime)) {
            return 0;
        }

        $overtimeHours = 0;
        $currentTime = clone $startOTTime;

        while ($currentTime->lt($checkOut)) {
            // Bỏ qua giờ nghỉ OT
            if ($currentTime->gte($breakOTStart) && $currentTime->lt($breakOTEnd)) {
                $currentTime = clone $breakOTEnd;
                continue;
            }

            // Dừng nếu vượt quá 23:15
            if ($currentTime->gte($endOTTime)) {
                break;
            }

            $overtimeHours += 0.5; // Tăng 30 phút mỗi lần
            $currentTime->addMinutes(30);
        }

        return $overtimeHours;
    }

    //tinh working time khi co in lack va out lack
    public function calculateWorkingTime(int $in_lack_time = 0, int $out_lack_time = 0)
    {
        $total_lack_time = $in_lack_time + $out_lack_time;
        // Khởi tạo working_time mặc định là 8 giờ
        $working_time = 8;

        // Nếu thời gian trễ ≤ 15 phút, không trừ giờ
        if ($total_lack_time <= 15) {
            return $working_time;
        }

        // Nếu thời gian trễ từ 16-30 phút, trừ 0.5 giờ
        if ($total_lack_time > 15 && $total_lack_time <= 30) {
            return $working_time - 0.5;
        }

        // Với thời gian trễ > 30 phút:
        // 1. Trừ 0.5 cho 30 phút đầu
        $working_time -= 0.5;

        // 2. Tính số khoảng 15 phút còn lại sau 30 phút
        $remaining_time = $total_lack_time - 30;
        $remaining_intervals = ceil($remaining_time / 15);

        // 3. Trừ 0.25 cho mỗi 15 phút còn lại
        if ($remaining_intervals > 0) {
            $working_time -= ($remaining_intervals * 0.25);
        }

        // Đảm bảo working_time không âm
        return max(0, $working_time);
    }

    public function calculateOutLackTime($actualTime)
    {
        $standardTime = Carbon::createFromTimeString(config('websetting.endWorkingTime'));

        // Chuyển actual time thành Carbon nếu chưa phải
        if (!($actualTime instanceof Carbon)) {
            $actualTime = Carbon::parse($actualTime);
        }

        $hour = $actualTime->hour;
        $minute = $actualTime->minute;

        if ($hour == 12) {
            $actualTime = Carbon::createFromTimeString('12:00');
        }

        // Nếu về sau hoặc đúng giờ thì không có lack time
        if ($actualTime->gte($standardTime)) {
            return 0;
        }

        // Tính số phút về sớm
        $lackMinutes = intval(abs($standardTime->diffInMinutes($actualTime)));

        return $hour <= 12 ? $lackMinutes - 60 : $lackMinutes;
    }

    public function calculateInLackTime($actualTime)
    {
//        $actualTime = Carbon::createFromTimeString('14:00:00');
        $standardTime = Carbon::createFromTimeString(config('websetting.startWorkingTime')); // 8:00
        $lunchBreakStart = Carbon::createFromTimeString('12:00:00');
        $lunchBreakEnd = Carbon::createFromTimeString('13:00:00');

        // Nếu không có giờ vào thì return 0
        if (!$actualTime) {
            return 0;
        }

        // Chuyển actual time thành Carbon nếu chưa phải
        if (!($actualTime instanceof Carbon)) {
            $actualTime = Carbon::parse($actualTime);
        }

        // Nếu vào sớm hơn hoặc đúng giờ thì không có lack time
        if ($actualTime->lte($standardTime)) {
            return 0;
        }

        // Tính số phút đi muộn
        $lackMinutes = 0;

        // Trường hợp 1: Đi muộn trước giờ nghỉ trưa
        if ($actualTime->lt($lunchBreakStart)) {
            $lackMinutes = $standardTime->diffInMinutes($actualTime);
        }
        // Trường hợp 2: Đi muộn trong giờ nghỉ trưa
        elseif ($actualTime->gte($lunchBreakStart) && $actualTime->lte($lunchBreakEnd)) {
            $lackMinutes = $standardTime->diffInMinutes($lunchBreakStart);
        }
        // Trường hợp 3: Đi muộn sau giờ nghỉ trưa
        else {
            // Tính từ giờ chuẩn (8:00) đến giờ nghỉ trưa (12:00)
            $morningLackMinutes = $standardTime->diffInMinutes($lunchBreakStart);

            // Tính từ hết giờ nghỉ trưa (13:00) đến giờ check in thực tế
            $afternoonLackMinutes = $lunchBreakEnd->diffInMinutes($actualTime);

            $lackMinutes = $morningLackMinutes + $afternoonLackMinutes;
        }

        return intval(abs($lackMinutes));
    }

    function startDayApplicationForm($user_id)
    {
        $lastCheckout = CheckInOut::where('user_id', $user_id)
            ->whereNotNull('check_out')
            ->where('status', true)
            ->where('auto_add', false)
            ->whereBetween('date', [
            now()->startOfMonth(),
            now()->endOfMonth()
        ])
            ->latest('date')
            ->first();

        if ($lastCheckout) {
            // Nếu có checkout gần nhất
            $startDate = Carbon::parse($lastCheckout->date);

            // Nếu ngày sau checkout là thứ 7 hoặc chủ nhật, tiến tới thứ 2
            while ($startDate->isWeekend()) {
                $startDate->addDay();
            }
        } else {
            $startDate = now()->startOfMonth();

            // Nếu mùng 1 là thứ 7 hoặc chủ nhật, tiến tới thứ 2
            while ($startDate->isWeekend()) {
                $startDate->addDay();
            }
        }
        //$startDate = now()->startOfMonth()->subMonth();
        return $startDate->format('Y-m-d');
    }

    /**
     * cal total time to leave
     *
     * @param string $start_time
     * @param string $end_time
     * @return array $totalTimeInHalfHours
     */
    function calculateTotalTime($start_date, $end_date, $start_time, $end_time, $leave_type) {
        // Chuyển đổi các tham số thành đối tượng Carbon
        $startDate = Carbon::parse($start_date);
        $endDate = Carbon::parse($end_date);
        $startTime = Carbon::parse($start_time)->format('H:i:s');
        $endTime = Carbon::parse($end_time)->format('H:i:s');

        // Thiết lập giờ làm việc
        $workStartTime = '08:00:00';
        $workEndTime = '17:00:00';

        // Tạo khoảng thời gian để duyệt qua các ngày
        $period = CarbonPeriod::create($startDate, $endDate);

        $totalLeaveHours = 0;

        foreach ($period as $date) {
            // Bỏ qua thứ 7 và chủ nhật
            if ($date->isWeekend()) {
                continue;
            }

            // Xử lý cho ngày đầu tiên
            if ($date->isSameDay($startDate)) {
                $dayStartTime = $startTime;
            } else {
                $dayStartTime = $workStartTime;
            }

            // Xử lý cho ngày cuối cùng
            if ($date->isSameDay($endDate)) {
                $dayEndTime = $endTime;
            } else {
                $dayEndTime = $workEndTime;
            }

            // Tính số giờ nghỉ trong ngày
            $start = Carbon::parse($dayStartTime);
            $end = Carbon::parse($dayEndTime);

            $diffInHours = $start->diffInHours($end);

            // Trừ đi thời gian nghỉ trưa (1 giờ) nếu thời gian nghỉ kéo dài qua giờ nghỉ trưa
            if ($start->format('H:i:s') < '12:00:00' && $end->format('H:i:s') > '13:00:00') {
                $diffInHours -= 1;
            }

            if ($end->format('H:i:s') >= '12:00:00' && $end->format('H:i:s') <= '13:00:00') {
                $diffInHours = floor($diffInHours);
            }
            // Chỉ tính là nghỉ phép nếu thời gian nghỉ trên 2 tiếng
            if ($diffInHours > 2) {
                // Nếu số giờ nghỉ vượt quá 8 tiếng, chỉ tính 8 tiếng
                $leaveHours = min($diffInHours, 8);
                $totalLeaveHours += $leaveHours;
            } else {
                $totalLeaveHours += $diffInHours;
            }
        }
        $messageError = "";
        if ($totalLeaveHours > 2 && is_numeric($totalLeaveHours) &&
            floor($totalLeaveHours) != $totalLeaveHours) {
            $messageError = __('messages.appForm.moreClear');
        }
        if ($totalLeaveHours < 2 && $leave_type != "2") {
            $messageError = __('messages.appForm.lessThan2hours');
        }
        return [
            'total_hours' => $totalLeaveHours,
            'message' => $messageError,
        ];
    }

    /**
     * Get check in status for user on current date
     *
     * @param int $userId
     * @return CheckInOut|null
     */
    public function getCheckInRecordExists(int $userId, $date = "")
    {
        $date = !$date ? date('Y-m-d') : $date;
        return CheckInOut::query()
            ->where('user_id', $userId)
            ->whereDate('date', $date)
            ->first();
    }

    /**
     * Get button display status based on check in status
     *
     * @param int $userId
     * @return string
     */
    public function getButtonDisplay(int $userId): string
    {
        return $this->getCheckInRecordExists($userId) ? CommonConstants::CHECK_OUT : CommonConstants::CHECK_IN;
    }
}
