<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OvertimeForm extends Model
{
    /** @use HasFactory<\Database\Factories\OvertimeFormFactory> */
    use HasFactory;

    protected $table = 'overtime_form';
    protected $fillable = [
        'user_id',
        'date',
        'start_time',
        'end_time',
        'paid_leave',
        'official_working_hours',
        'over_time',
        'total_time',
        'verify_status',
        'approved_by',
        'created_by',
        'updated_by',
    ];

    protected $attributes = [
        'verify_status' => false,
        'updated_by' => null,
//        'out_lack_time' => null,
//        'over_time' => null,
    ];

    protected $casts = [
        'date' => 'date',
        'start_time' => 'string',
        'end_time' => 'string',
        'paid_leave' => 'double',
        'official_working_hours' => 'double',
        'over_time' => 'double',
        'total_time' => 'double',
        'verify_status' => 'boolean',
        'approved_by' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function getCheckInAttribute($value)
    {
        return Carbon::createFromFormat('H:i:s', $value);
    }

    public function getCheckOutAttribute($value)
    {
        return $value ? Carbon::createFromFormat('H:i:s', $value) : null;
    }

    // Mutator để lưu check_in và check_out dưới dạng 'H:i:s'
    public function setCheckInAttribute($value)
    {
        $this->attributes['check_in'] = Carbon::parse($value)->format('H:i:s');
    }

    public function setCheckOutAttribute($value)
    {
        $this->attributes['check_out'] = $value ? Carbon::parse($value)->format('H:i:s') : null;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

//    public function approver()
//    {
//        return $this->belongsTo(User::class, 'approved_by');
//    }
}
