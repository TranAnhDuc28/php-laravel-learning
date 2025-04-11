<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationForm extends Model
{
    /** @use HasFactory<\Database\Factories\ApplicationFormFactory> */
    use HasFactory;

    protected $table = 'application_form';
    protected $fillable = [
        'user_id',
        'leave_type',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'leave_reason',
        'total_hours',
        'verify_status',
        'approved_by',
        'created_by',
        'updated_by'
    ];

    protected $attributes = [
        'approved_by' => null,
        'updated_by' => null,
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'start_time' => 'string',
        'end_time' => 'string',
        'verify_status' => 'boolean',
        'total_hours' => 'double',
        'approved_by' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function getStartTimeAttribute($value)
    {
        return Carbon::createFromFormat('H:i:s', $value);
    }

    // Mutator 'H:i:s'
    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = Carbon::parse($value)->format('H:i:s');
    }

    public function getEndTimeAttribute($value)
    {
        return Carbon::createFromFormat('H:i:s', $value);
    }

    // Mutator 'H:i:s'
    public function setEndTimeAttribute($value)
    {
        $this->attributes['end_time'] = Carbon::parse($value)->format('H:i:s');
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
