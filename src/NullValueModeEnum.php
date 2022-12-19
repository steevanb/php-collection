<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray;

enum NullValueModeEnum: int
{
    case ALLOW = 1;
    case DO_NOT_ADD = 2;
    case EXCEPTION = 3;
}
