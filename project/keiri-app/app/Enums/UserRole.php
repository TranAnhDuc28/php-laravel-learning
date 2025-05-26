<?php

namespace App\Enums;

use App\Traits\LocalizedEnum;

enum UserRole: int
{
    use LocalizedEnum;
    case ADMIN = 9;
    case HR = 3;
    case MANAGER = 2;
    case EMPLOYEE = 1;

}
