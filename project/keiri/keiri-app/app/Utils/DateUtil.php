<?php

namespace App\Utils;

use Carbon\CarbonInterface;
use Carbon\CarbonPeriod;
use Illuminate\Support\Carbon;

class DateUtil
{
    /**
     * Calculation working days
     */
    public static function workingDaysBetween(string $startDate, string $endDate, array $excludedDates = [CarbonInterface::SATURDAY, CarbonInterface::SUNDAY]): int
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        $period = CarbonPeriod::create($start, $end);

        return $period->filter(function ($date) use ($excludedDates) {
            return !in_array($date->dayOfWeek, $excludedDates);
        })->count();
    }
}
