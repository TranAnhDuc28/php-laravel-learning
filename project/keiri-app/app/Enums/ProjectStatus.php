<?php

namespace App\Enums;

use Illuminate\Support\Facades\App;

enum ProjectStatus: int
{
    case NOT_STARTED = 0;
    case IN_PROGRESS = 1;
    case COMPLETED = 2;
}
