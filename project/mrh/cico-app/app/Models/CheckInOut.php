<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class CheckInOut extends Model
{
    /** @use HasFactory<\Database\Factories\CheckInOutFactory> */
    use HasFactory;

    protected $table = 'check_in_out';

    protected $fillable = [
        'user_id',
        'date',
        'check_in',
        'check_out',
        'in_lack_time',
        'out_lack_time',
        'over_time',
        'paid_leave',
        'unpaid_leave',
        'working_time',
        'official_working_hours',
        'status'  // Thêm status vào fillable vì có dùng trong approval
    ];

    protected $attributes = [
        'check_in' => null,        // Thêm giá trị mặc định cho check_in
        'check_out' => null,
        'in_lack_time' => 0,
        'out_lack_time' => 0,
        'over_time' => 0,
        'paid_leave' => 0,
        'unpaid_leave' => 0,
        'working_time' => 0,
        'official_working_hours' => 0,
        'status' => true
    ];

    protected $casts = [
        'date' => 'date',
        'check_in' => 'string',
        'check_out' => 'string',
        'in_lack_time' => 'integer',
        'out_lack_time' => 'integer',
        'over_time' => 'double',
        'paid_leave' => 'double',
        'unpaid_leave' => 'double',
        'working_time' => 'double',
        'official_working_hours' => 'double',
        'status' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function getCheckInAttribute($value)
    {
        return Carbon::createFromFormat('H:i:s', $value);
    }

    public function getCheckOutAttribute($value)
    {
        return $value ? Carbon::createFromFormat('H:i:s', $value) : null;
    }

    // Mutator để lưu check_in và check_out dưới dạng 'H:i:s'
    public function setCheckInAttribute($value)
    {
        $this->attributes['check_in'] = Carbon::parse($value)->format('H:i:s');
    }

    public function setCheckOutAttribute($value)
    {
        $this->attributes['check_out'] = $value ? Carbon::parse($value)->format('H:i:s') : null;
    }

    public function scopeForUserAndDate($query, $userId, $date)
    {
        return $query->where('user_id', $userId)
            ->where('date', $date);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Helper method để kiểm tra xem record đã tồn tại chưa
     */
    public static function recordExists($userId, $date)
    {
        return static::forUserAndDate($userId, $date)->exists();
    }

    /**
     * Helper method để xóa record hiện tại một cách an toàn
     */
    public static function safeDelete($userId, $date)
    {
        return static::forUserAndDate($userId, $date)->delete();
//        return static::forUserAndDate($userId, $date)->forceDelete();
    }
}
