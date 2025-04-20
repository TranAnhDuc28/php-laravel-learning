<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'start',
        'end',
        'all_day',
        'department',
        'location',
        'description',
        'url',
    ];

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
        'allDay' => 'boolean'
    ];
}
