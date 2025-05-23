<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectAssignmentLog extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'project_assignment_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'project_id',
        'project_assignment_id',
        'project_join_date',
        'project_exit_date',
        'effort_percentage',
        'worked_days',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'project_id' => 'integer',
        'project_assignment_id' => 'integer',
        'worked_days' => 'integer',
        'project_join_date' => 'date',
        'project_exit_date' => 'date',
    ];

    /**
     * Get the project that the user participates in.
     */
    public function assign(): BelongsTo
    {
        return $this->belongsTo(ProjectAssignment::class);
    }
}
