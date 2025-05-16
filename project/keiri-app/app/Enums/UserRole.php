<?php

namespace App\Enums;

use App\Traits\LocalizedEnum;

enum UserRole: int
{
    use LocalizedEnum;
    case Admin = 9;
    case Hr = 3;
    case Manager = 2;
    case Employee = 1;

}
