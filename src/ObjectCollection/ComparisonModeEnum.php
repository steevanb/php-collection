<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

enum ComparisonModeEnum: int
{
    case STRING = 1;
    case HASH = 2;
}
