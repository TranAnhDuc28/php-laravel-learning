<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    protected $fillable = [
        'post_id',
        'message'
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
