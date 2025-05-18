<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'projects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_code',
        'project_name',
        'project_start_date',
        'project_end_date',
        'phase',
        'priority',
        'status',
        'note',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'project_start_date' => 'date',
        'project_end_date' => 'date',
        'phase' => 'integer',
        'priority' => 'integer',
        'status' => 'integer',
    ];

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'project_assignments')
            ->using(ProjectAssignment::class)
            ->withPivot(['project_join_date', 'project_exit_date', 'effort_percentage', 'status', 'note'])
            ->withTimestamps();
    }
}
