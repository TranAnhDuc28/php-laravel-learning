<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
//    use HasFactory;
    protected $table = 'project_users';
    public $timestamps = false;
    protected $fillable = ['project_id', 'user_id'];

    protected $attributes = [
        'project_id' => null,
        'user_id' => null,
    ];

    protected $casts = [
        'user_id' => 'integer',
        'project_id' => 'integer',
//        'max_members' => 'integer',
//        'created_at' => 'datetime',
//        'updated_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Projects::class);
    }

//    // Helper function để check role
//    public function isLeader()
//    {
//        return $this->role === self::ROLE_LEADER;
//    }
//
//    public function isMember()
//    {
//        return $this->role === self::ROLE_MEMBER;
//    }
}
