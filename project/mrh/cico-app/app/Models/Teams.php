<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teams extends Model
{
    /** @use HasFactory<\Database\Factories\TeamsFactory> */
    use HasFactory;

    protected $table = 'teams';
    public $timestamps = false;
    protected $fillable = [
        'team_name',
    ];

    protected $casts = [
        'team_name' => 'string',
//        'is_active' => 'boolean',
//        'max_members' => 'integer',
//        'created_at' => 'datetime',
//        'updated_at' => 'datetime'
    ];

    protected $attributes = [
        'team_name' => null,
    ];

    public function teamUser(): HasMany
    {
        return $this->hasMany(TeamUser::class, 'team_id', 'id');
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
