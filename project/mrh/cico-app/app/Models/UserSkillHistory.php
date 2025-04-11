<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSkillHistory extends Model
{
    protected $table = 'user_skill_history';

    protected $fillable = [
        'id',
        'user_id',
        'skill',
        'description'
    ];

    /**
     * Get the owner of this.
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
