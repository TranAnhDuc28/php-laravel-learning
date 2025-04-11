<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SkillItem extends Model
{
    protected $table = 'skill_item';

    protected $fillable = [
        'id',
        'category_id',
        'code',
        'name',
        'display_order',
        'is_featured',
        'text_color',
        'bg_color',
        'description'
    ];

    /**
     * Get the owner of this.
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(SkillCategory::class, 'category_id');
    }
}
