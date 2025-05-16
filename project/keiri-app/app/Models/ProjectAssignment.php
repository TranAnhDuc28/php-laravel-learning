<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectAssignment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'project_assignments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'project_id',
        'project_join_date',
        'project_exit_date',
        'effort_percentage',
        'status',
        'note',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'project_join_date' => 'date',
        'project_exit_date' => 'date',
        'effort_percentage' => 'integer',
        'status' => 'integer',
    ];

    /**
     * Get the user who participates in the project.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the project that the user participates in.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
