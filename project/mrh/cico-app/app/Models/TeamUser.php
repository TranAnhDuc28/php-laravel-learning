<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamUser extends Model
{
    use HasFactory;
    protected $fillable = ['team_id', 'user_id', 'role'];

    protected $attributes = [
        'team_id' => null,
        'role' => null,
    ];

    protected $casts = [
        'role' => 'integer',
        'team_id' => 'string',
//        'max_members' => 'integer',
//        'created_at' => 'datetime',
//        'updated_at' => 'datetime'
    ];
    const ROLE_MEMBER = 2;
    const ROLE_MANAGER = 1;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function teams()
    {
        return $this->belongsTo(Teams::class);
    }

    // Helper function để check role
    public function isLeader()
    {
        return $this->role === self::ROLE_MANAGER;
    }

    public function isMember()
    {
        return $this->role === self::ROLE_MEMBER;
    }
}
