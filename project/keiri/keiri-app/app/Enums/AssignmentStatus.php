<?php

namespace App\Enums;

use App\Traits\LocalizedEnum;

enum AssignmentStatus: int
{
    case ACTIVE = 1;
    case INACTIVE = 2;
}
