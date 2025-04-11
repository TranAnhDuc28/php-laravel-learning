<?php

namespace App\Enums;

enum LeaveType: int
{
//    case ADMIN = 0;
    case PL = 1;
    case UL = 2;
    case PL_IA = 3;
    case CL = 4;
    case SL = 5;
    case PPL = 6;
    case CBL = 7;
    case CO_PL = 8;
    case OTHER = 9;

    public function label(): string
    {
        return match($this) {
            self::PL => 'Paid Leave', //Nghỉ phép
            self::UL => 'Unpaid Leave', //Nghỉ không lương
            self::PL_IA => 'Paid Leave in advance', //Nghỉ ứng phép
            self::CL => 'Compensation Leave', //Nghỉ bù
            self::SL => 'Special Leave', //Nghỉ việc riêng hưởng lương
            self::PPL => 'Planned Paid Leave', //Nghỉ phép có kế hoạch
            self::CBL => 'Child-Bearing Leave', //Nghỉ thai sản
            self::CO_PL => 'Carried over Paid leave', //Chuyển phép
            self::OTHER => 'Other Leave', //Nghỉ khác
        };
    }

//    use App\Enums\UserRole;
//
//    $status = LeaveType::ADMIN;
//    echo $status->value; // 0
//    echo $status->label(); // "Administrator"
}
