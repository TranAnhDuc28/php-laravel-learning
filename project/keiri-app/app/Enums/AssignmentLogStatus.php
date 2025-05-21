<?php

namespace App\Enums;

use App\Traits\LocalizedEnum;

enum AssignmentLogStatus: int
{
    /* Đang tham gia. */
    case ACTIVE = 1;

    /* Đã kết thúc */
    case INACTIVE = 2;
}
