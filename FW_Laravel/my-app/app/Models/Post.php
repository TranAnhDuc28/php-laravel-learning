<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    /**
     * Làm việc với Eloquent
     * @var string[]
     */
    protected $fillable = [
        'id',
        'title',
        'body',
        'user_id',
    ];
}
