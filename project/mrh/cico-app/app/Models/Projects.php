<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Projects extends Model
{
//    /** @use HasFactory<\Database\Factories\ProjectsFactory> */
//    use HasFactory;

    protected $table = 'projects';
    public $timestamps = false;
    protected $fillable = [
        'project_name',
        'user_id'
    ];

    protected $casts = [
        'project_name' => 'string',
//        'is_active' => 'boolean',
        'user_id' => 'integer',
//        'created_at' => 'datetime',
//        'updated_at' => 'datetime'
    ];

    protected $attributes = [
        'project_name' => null,
        'user_id' => 0,
    ];

    public function projectUser(): HasMany
    {
        return $this->hasMany(ProjectUser::class, 'project_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
//    // Scope để lọc team đang hoạt động
//    public function scopeActive($query)
//    {
//        return $query->where('is_active', true);
//    }

//    // Method để tạo team mới
//    public static function createTeam(array $data)
//    {
//        return self::create($data);
//    }

//    // Method để cập nhật thông tin team
//    public function updateTeam(array $data)
//    {
//        return $this->update($data);
//    }

//    // Method để xóa team
//    public function deleteTeam()
//    {
//        return $this->delete();
//    }

//    // Method để lấy danh sách team với phân trang
//    public static function getTeamsList($perPage = 10)
//    {
//        return self::latest()->paginate($perPage);
//    }

//    // Method để tìm kiếm team theo tên
//    public static function searchTeams($keyword)
//    {
//        return self::where('team_name', 'LIKE', "%{$keyword}%")
//            ->orWhere('description', 'LIKE', "%{$keyword}%")
//            ->paginate(10);
//    }

//    // Method để kiểm tra xem team có còn slot trống không
//    public function hasAvailableSlots()
//    {
//        return $this->users()->count() < $this->max_members;
//    }
}
