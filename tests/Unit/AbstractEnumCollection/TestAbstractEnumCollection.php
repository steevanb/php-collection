<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\AbstractEnumCollection;

use Steevanb\PhpCollection\EnumCollection\AbstractEnumCollection;

class TestAbstractEnumCollection extends AbstractEnumCollection
{
    public function __construct(string $className = TestEnum::class, iterable $values = [])
    {
        parent::__construct($className, $values);
    }

    public function callCastValueToString(\UnitEnum $enum): string
    {
        return $this->castValueToString($enum);
    }
}
