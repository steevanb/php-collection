<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\Tests\Unit\AbstractEnumArray;

use Steevanb\PhpTypedArray\EnumArray\AbstractEnumArray;

class TestAbstractEnumArray extends AbstractEnumArray
{
    public function callCastValueToString(\UnitEnum $enum): string
    {
        return $this->castValueToString($enum);
    }
}
