<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection;

enum KeyCaseEnum: int
{
    case UPPER = 1; // CASE_UPPER, we can't use constants here before PHP 8.2
    case LOWER = 0; // CASE_LOWER, we can't use constants here before PHP 8.2
}
