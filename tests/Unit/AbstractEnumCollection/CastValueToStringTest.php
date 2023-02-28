<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\AbstractEnumCollection;

use PHPUnit\Framework\TestCase;

final class CastValueToStringTest extends TestCase
{
    public function testEnum(): void
    {
        static::assertSame(
            'VALUE1',
            (new TestAbstractEnumCollection())->callCastValueToString(TestEnum::VALUE1)
        );
    }

    public function testStringEnum(): void
    {
        static::assertSame(
            'VALUE1',
            (new TestAbstractEnumCollection())->callCastValueToString(TestStringEnum::VALUE1)
        );
    }

    public function testIntEnum(): void
    {
        static::assertSame(
            '1',
            (new TestAbstractEnumCollection())->callCastValueToString(TestIntEnum::VALUE1)
        );
    }
}
