<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class SkillCategory extends Model
{
    protected $table = 'skill_category';

    protected $fillable = [
        'id',
        'code',
        'name',
        'display_order',
        'is_featured',
        'text_color',
        'bg_color',
        'description',
    ];

    /**
     * Get all the children.
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(SkillItem::class, 'category_id')
            ->orderBy('display_order')
            ->orderBy('name');
    }
}
