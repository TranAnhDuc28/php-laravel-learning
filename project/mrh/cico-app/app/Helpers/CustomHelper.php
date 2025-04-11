<?php
namespace App\Helpers;

class CustomHelper
{
    public static function customRound($value)
    {
        if ($value < 0.125) {
            return round($value, 2, PHP_ROUND_HALF_DOWN);
        }

        return round($value, 2);
    }
}
