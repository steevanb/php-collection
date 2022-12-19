<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\Tests\Unit\AbstractEnumArray;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpTypedArray\Exception\InvalidTypeException;

final class ConstructTest extends TestCase
{
    public function testDefaultValues(): void
    {
        static::assertNull((new TestAbstractEnumArray())->getClassName());
    }

    public function testEnum(): void
    {
        $enumArray = new TestAbstractEnumArray([], TestEnum::class);

        static::assertSame(TestEnum::class, $enumArray->getClassName());
    }

    public function testStringEnum(): void
    {
        $enumArray = new TestAbstractEnumArray([], TestStringEnum::class);

        static::assertSame(TestStringEnum::class, $enumArray->getClassName());
    }

    public function testIntEnum(): void
    {
        $enumArray = new TestAbstractEnumArray([], TestIntEnum::class);

        static::assertSame(TestIntEnum::class, $enumArray->getClassName());
    }

    public function testObject(): void
    {
        $this->expectException(InvalidTypeException::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage(
            'Steevanb\PhpTypedArray\EnumArray\AbstractEnumArray can store only UnitEnum. Use'
                . ' Steevanb\PhpTypedArray\ObjectArray\ObjectArray if you want to store objects.'
        );
        new TestAbstractEnumArray([], \stdClass::class);
    }
}
