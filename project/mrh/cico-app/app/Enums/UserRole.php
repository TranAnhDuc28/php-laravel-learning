<?php

namespace App\Enums;

enum UserRole: int
{
    case ADMIN = 0;
    case MEM = 1;

    case MOD = 2;
    case LEAD = 3;

    public function label(): string
    {
        return match($this) {
            self::ADMIN => 'Administrator',
            self::MEM => 'Member',
            self::MOD => 'Moderator',
            self::LEAD => 'Leader',
        };
    }

//    use App\Enums\UserRole;
//
//    $status = UserRole::ADMIN;
//    echo $status->value; // 0
//    echo $status->label(); // "Administrator"
}
