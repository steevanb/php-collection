<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray;

enum ObjectComparisonModeEnum: int
{
    case STRING = 1;
    case HASH = 2;
}
