<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\Tests\Unit\AbstractEnumArray;

use PHPUnit\Framework\TestCase;

final class CastValueToStringTest extends TestCase
{
    public function testEnum(): void
    {
        static::assertSame(
            'VALUE1',
            (new TestAbstractEnumArray())->callCastValueToString(TestEnum::VALUE1)
        );
    }

    public function testStringEnum(): void
    {
        static::assertSame(
            'VALUE1',
            (new TestAbstractEnumArray())->callCastValueToString(TestStringEnum::VALUE1)
        );
    }

    public function testIntEnum(): void
    {
        static::assertSame(
            '1',
            (new TestAbstractEnumArray())->callCastValueToString(TestIntEnum::VALUE1)
        );
    }
}
