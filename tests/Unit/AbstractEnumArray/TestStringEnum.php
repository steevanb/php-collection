<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\Tests\Unit\AbstractEnumArray;

enum TestStringEnum: string
{
    case VALUE1 = 'VALUE1';
    case VALUE2 = 'VALUE2';
    case VALUE3 = 'VALUE3';
}
