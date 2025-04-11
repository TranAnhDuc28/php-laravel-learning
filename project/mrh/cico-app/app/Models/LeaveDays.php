<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveDays extends Model
{
    protected $table = 'leave_days';
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
        'year'
    ];

    protected $attributes = [
        'days_off_in_advance' => 0.0,
        'days_off' => 0.0,
        'award_days_off' => 0.0,
        'days_off_to_june' => 0.0,
        'compensatory_day_off' => 0.0,
        'carried_days_off' => 0.0,
        'days_off_to_used' => 0.0,
        'days_off_in_advance_to_used' => 0.0,
        'year' => null, // Hoặc năm hiện tại
    ];

    protected $casts = [
        'days_off_in_advance' => 'float',
        'days_off' => 'float',
        'award_days_off' => 'float',
        'days_off_to_june' => 'float',
        'compensatory_day_off' => 'float',
        'carried_days_off' => 'float',
        'days_off_to_used' => 'float',
        'days_off_in_advance_to_used' => 'float',
        'year' => 'integer',
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->year = $model->year ?? now()->year;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
