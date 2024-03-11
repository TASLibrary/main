<?php

namespace App\Enum;

enum IssueStatus: int
{
    case Pending = 0;

    case Resolved = 1;
}
