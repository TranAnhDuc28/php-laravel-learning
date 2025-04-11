<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    const ROLE_ADMIN = 0;
    const ROLE_MEM = 1;
    const ROLE_MOD = 2;
    const ROLE_PU = 9;

    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
        'join_date',
        'skill',
        'skill_updated_at',
    ];

    protected $attributes = [
        'join_date' => null,
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
            'email_verified_at' => 'datetime',
            'skill_updated_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function leaveDaysLog(): HasMany
    {
        return $this->hasMany(LeaveDaysLog::class, 'user_id', 'id');
    }

    public function leaveDays(): HasMany
    {
        return $this->hasMany(LeaveDays::class, 'user_id', 'id');
    }

    public function checkInOuts(): HasMany
    {
        return $this->hasMany(CheckInOut::class, 'user_id', 'id');
    }

    public function applicationForm(): HasMany
    {
        return $this->hasMany(ApplicationForm::class, 'user_id', 'id');
    }

    public function teamuser(): HasMany
    {
        return $this->hasMany(TeamUser::class, 'user_id', 'id');
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Projects::class, 'user_id', 'id');
    }

    public function isManager()
    {
        return $this->projects()
            ->where('user_id', $this->id)
            ->exists();
    }

    public function isLeader()
    {
        return $this->teamuser()
            ->where('user_id', $this->id)
            ->where('role', TeamUser::ROLE_MANAGER)
            ->exists();
    }

    public function isMember()
    {
        return $this->teamuser()
            ->where('user_id', $this->id)
            ->where('role', TeamUser::ROLE_MEMBER)
            ->exists();
    }

    public function isPu()
    {
        return $this->role === self::ROLE_PU;
    }

    public function isAd()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isMem()
    {
        return $this->role === self::ROLE_MEM;
    }

    public function isMod()
    {
        return $this->role === self::ROLE_MOD;
    }
}
