<?php

namespace App\Enum;

enum MessageStatus: int
{
    case Pending = 0;

    case Resolved = 1;
}
