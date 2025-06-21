<?php

namespace App\Enums;

use Illuminate\Support\Facades\App;

enum ProjectPriority: int
{
    case HIGH = 1;
    case LOW = 2;
    case MEDIUM = 3;
}
