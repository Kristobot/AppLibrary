<?php

namespace App\Enums;

enum CopyStatusEnum : int
{
    case AVAILABLE = 1;
    case RESERVED = 2;
    case IN_REPAIR = 3;
    case EXTRAORDINARY = 4;
}