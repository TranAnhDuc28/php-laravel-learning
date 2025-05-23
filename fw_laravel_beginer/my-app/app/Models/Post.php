<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
