<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $table = 'flights';

    protected $fillable = [
        'name',
        'options',
        'delayed'
    ];

    protected $attributes = [
        'options' => '[]',
        'delayed' => false,
    ];
}
