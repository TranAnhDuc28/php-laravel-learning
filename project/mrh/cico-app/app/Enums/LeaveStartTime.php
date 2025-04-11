<?php

namespace App\Enums;

enum LeaveStartTime: int
{
//    case ADMIN = 0;
    case EI_AM = 8;
    case NI_AM = 9;
    case TE_AM = 10;
    case EL_AM = 11;
    case TW_PM = 12;
    case ON_PM = 13;
    case TWO_PM = 14;
    case TH_PM = 15;
    case FO_PM = 16;
    case FI_PM = 17;

    public function label(): string
    {
        return match($this) {
            self::EI_AM => "08",
            self::NI_AM => "09",
            self::TE_AM => "10",
            self::EL_AM => "11",
            self::TW_PM => "12",
            self::ON_PM => "13",
            self::TWO_PM => "14",
            self::TH_PM => "15",
            self::FO_PM => "16",
            self::FI_PM => "17",
        };
    }

//    use App\Enums\UserRole;
//
//    $status = UserRole::ADMIN;
//    echo $status->value; // 0
//    echo $status->label(); // "Administrator"
}
