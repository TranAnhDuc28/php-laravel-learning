<?php

namespace App\Enums;

enum EventType: int
{
    case DANGER = 1; // Quan trọng, cảnh báo.
    case DARK = 2; // Trung lập, không phân loại.
    case INFO = 3; // Thông báo chung.
    case PRIMARY = 4; // Sự kiện chính.
    case SUCCESS = 5; // Thành công, đã hoàn thành.
    case WARNING = 6; // Cảnh báo nhẹ.

    public function label(): string
    {
        return match($this) {
            self::DANGER => 'danger',
            self::DARK => 'dark',
            self::INFO => 'info',
            self::PRIMARY => 'primary',
            self::SUCCESS => 'success',
            self::WARNING => 'warning',
        };
    }

    public function className(): string
    {
        return "bg-" . $this->label() . "-subtle";
    }

    public static function fromValue(int|string|null $value): ?self
    {
        if (is_null($value)) {
            return null;
        }
        return self::tryFrom((int)$value);
    }
}
