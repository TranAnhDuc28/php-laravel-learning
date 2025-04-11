<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\ApplicationForm;
use Carbon\Carbon;

class NoTimeOverlap implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $start_date = request()->input('start_date');
        $start_hour = request()->input('start_time_hour');
        $start_minute = request()->input('start_time_minute');
        $end_date = request()->input('end_date');
        $end_hour = request()->input('end_time_hour');
        $end_minute = request()->input('end_time_minute');

        if (!$start_date || !$start_hour || !$start_minute ||
            !$end_date || !$end_hour || !$end_minute) return;

        $startDateTime = Carbon::parse("$start_date $start_hour:$start_minute");
        $endDateTime = Carbon::parse("$end_date $end_hour:$end_minute");

        $existingApplication = ApplicationForm::where(function ($query) use ($startDateTime, $endDateTime) {
            $query->where(function ($q) use ($startDateTime, $endDateTime) {
                // Kiểm tra xem thời gian mới có overlap với thời gian đã đăng ký không
                $q->where(function ($subQ) use ($startDateTime, $endDateTime) {
                    $subQ->whereRaw("CONCAT(start_date, ' ', start_time) < ?", [$endDateTime])
                        ->whereRaw("CONCAT(end_date, ' ', end_time) > ?", [$startDateTime]);
                });
            })
                ->where('user_id', auth()->id());
        })->first();

        if ($existingApplication) {
            $fail('This time is already registered. Please choose another time.');
        }
    }
}
