<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\AbstractEnumCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\{
    Exception\InvalidTypeException,
    ValueAlreadyExistsModeEnum
};

final class ConstructTest extends TestCase
{
    public function testDefaultValues(): void
    {
        $collection = new TestAbstractEnumCollection(TestEnum::class);

        static::assertSame(
            'Steevanb\PhpCollection\Tests\Unit\AbstractEnumCollection\TestEnum',
            $collection->getClassName()
        );
        static::assertSame(ValueAlreadyExistsModeEnum::ADD, $collection->getValueAlreadyExistsMode());
    }

    public function testEnum(): void
    {
        $collection = new TestAbstractEnumCollection(TestEnum::class);

        static::assertSame(TestEnum::class, $collection->getClassName());
    }

    public function testStringEnum(): void
    {
        $collection = new TestAbstractEnumCollection(TestStringEnum::class);

        static::assertSame(TestStringEnum::class, $collection->getClassName());
    }

    public function testIntEnum(): void
    {
        $collection = new TestAbstractEnumCollection(TestIntEnum::class);

        static::assertSame(TestIntEnum::class, $collection->getClassName());
    }

    public function testObject(): void
    {
        $this->expectException(InvalidTypeException::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage(
            'Steevanb\PhpCollection\EnumCollection\AbstractEnumCollection can store only UnitEnum or BackedEnum. '
            . 'Use Steevanb\PhpCollection\ObjectCollection\AbstractObjectCollection or '
            . 'Steevanb\PhpCollection\ObjectCollection\AbstractObjectNullableCollection if you want to store objects.'
        );
        new TestAbstractEnumCollection(\stdClass::class);
    }
}
