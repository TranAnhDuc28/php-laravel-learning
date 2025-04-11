<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveDaysLog extends Model
{
    protected $table = 'leave_days_log';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'days_off_in_advance',
        'days_off',
        'award_days_off',
        'days_off_to_june',
        'compensatory_day_off',
        'carried_days_off',
        'days_off_to_used',
        'days_off_in_advance_to_used',
        'pl_to_used_m',
        'plan_pl_to_used_m',
        'pl_in_advance_to_used_m',
        'un_pl_to_used_m',
        'sl_to_used_m',
        'compensatory_day_to_used_m',
        'all_pl_available_m',
        'all_pl_to_used_m',
        'all_pl_remain_to_use_m',
        'date'
    ];

//    protected $attributes = [
//        'days_off_in_advance' => 0.0,
//        'days_off' => 0.0,
//        'award_days_off' => 0.0,
//        'days_off_to_june' => 0.0,
//        'compensatory_day_off' => 0.0,
//        'carried_days_off' => 0.0,
//        'days_off_to_used' => 0.0,
//        'days_off_in_advance_to_used' => 0.0,
//        'year' => null, // Hoặc năm hiện tại
//    ];

    protected $casts = [
        'days_off_in_advance' => 'double',
        'days_off' => 'double',
        'award_days_off' => 'double',
        'days_off_to_june' => 'double',
        'compensatory_day_off' => 'double',
        'carried_days_off' => 'double',
        'days_off_to_used' => 'double',
        'days_off_in_advance_to_used' => 'double',
        'pl_to_used_m' => 'double',
        'plan_pl_to_used_m' => 'double',
        'pl_in_advance_to_used_m' => 'double',
        'un_pl_to_used_m' => 'double',
        'sl_to_used_m' => 'double',
        'compensatory_day_to_used_m' => 'double',
        'all_pl_available_m' => 'double',
        'all_pl_to_used_m' => 'double',
        'all_pl_remain_to_use_m' => 'double',
        'date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

//    protected static function booted(): void
//    {
//        static::creating(function ($model) {
//            $model->date = $model->year ?? now()->year;
//        });
//    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
