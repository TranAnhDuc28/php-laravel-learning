<?php

namespace App\Models;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'role',
        'job_position',
        'join_date',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => UserStatus::class,
            'password' => 'hashed',
            'role' => UserRole::class,
            'email_verified_at' => 'datetime',
        ];
    }

    /**
     * @return BelongsToMany
     */
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_assignments')
            ->using(ProjectAssignment::class)
            ->withPivot(['project_join_date', 'project_exit_date', 'effort_percentage', 'status', 'note'])
            ->withTimestamps();
    }

    /**
     * Check user is Admin or not.
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role == UserRole::Admin;
    }

    /**
     * Check user is Manager or not.
     * @return bool
     */
    public function isManager(): bool
    {
        return $this->role == UserRole::Manager;
    }

    /**
     * Check user is Hr or not.
     * @return bool
     */
    public function isHr(): bool
    {
        return $this->role == UserRole::Hr;
    }

    /**
     * Check user is Employee or not.
     * @return bool
     */
    public function isEmployee(): bool
    {
        return $this->role == UserRole::Employee;
    }
}
