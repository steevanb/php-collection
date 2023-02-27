<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\Tests\Unit\AbstractEnumArray;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpTypedArray\{
    Exception\InvalidTypeException,
    ValueAlreadyExistsModeEnum
};

final class ConstructTest extends TestCase
{
    public function testDefaultValues(): void
    {
        $array = new TestAbstractEnumArray(TestEnum::class);

        static::assertSame(
            'Steevanb\PhpTypedArray\Tests\Unit\AbstractEnumArray\TestEnum',
            $array->getClassName()
        );
        static::assertSame(ValueAlreadyExistsModeEnum::ADD, $array->getValueAlreadyExistMode());
    }

    public function testEnum(): void
    {
        $enumArray = new TestAbstractEnumArray(TestEnum::class);

        static::assertSame(TestEnum::class, $enumArray->getClassName());
    }

    public function testStringEnum(): void
    {
        $enumArray = new TestAbstractEnumArray(TestStringEnum::class);

        static::assertSame(TestStringEnum::class, $enumArray->getClassName());
    }

    public function testIntEnum(): void
    {
        $enumArray = new TestAbstractEnumArray(TestIntEnum::class);

        static::assertSame(TestIntEnum::class, $enumArray->getClassName());
    }

    public function testObject(): void
    {
        $this->expectException(InvalidTypeException::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage(
            'Steevanb\PhpTypedArray\EnumArray\AbstractEnumArray can store only UnitEnum or BackedEnum. '
            . 'Use Steevanb\PhpTypedArray\ObjectArray\AbstractObjectArray or '
            . 'Steevanb\PhpTypedArray\ObjectArray\AbstractObjectNullableArray if you want to store objects.'
        );
        new TestAbstractEnumArray(\stdClass::class);
    }
}
