<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'start',
        'end',
        'allDay',
        'className',
        'location',
        'description'
    ];

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
        'allDay' => 'boolean'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * Customize the data for serialization
     *
     * @return array
     */
    public function toArray()
    {
        $array = parent::toArray();
        return array_filter($array, function ($value) {
            return $value !== null;
        });
    }
} 