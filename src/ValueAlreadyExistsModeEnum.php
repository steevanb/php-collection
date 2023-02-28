<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection;

enum ValueAlreadyExistsModeEnum: int
{
    case ADD = 1;
    case DO_NOT_ADD = 2;
    case EXCEPTION = 3;
}
