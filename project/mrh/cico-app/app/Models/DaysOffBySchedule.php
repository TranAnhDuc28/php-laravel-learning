<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaysOffBySchedule extends Model
{
    protected $table = 'days_off_by_schedule';

    protected $fillable = [
        'start_date',
        'end_date',
        'leave_type'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'leave_type' => 'integer',
    ];
}
