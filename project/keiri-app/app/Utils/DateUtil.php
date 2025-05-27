<?php

namespace App\Utils;

use Carbon\CarbonPeriod;
use Illuminate\Support\Carbon;

class DateUtil
{
    /**
     * Calculation working days
     */
    public static function workingDaysBetween(string $startDate, string $endDate, array $excludedDates = [Carbon::SATURDAY, Carbon::SUNDAY]): int
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        $period = CarbonPeriod::create($start, $end);

        return $period->filter(function ($date) use ($excludedDates) {
            return !in_array($date->dayOfWeek, $excludedDates);
        })->count();
    }
}
