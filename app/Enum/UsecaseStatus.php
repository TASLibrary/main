<?php

namespace App\Enum;

enum UsecaseStatus: int
{
    case Pending = 0;

    case Approved = 1;

    case Rejected = 2;
}
