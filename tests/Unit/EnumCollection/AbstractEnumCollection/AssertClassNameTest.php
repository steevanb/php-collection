<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\EnumCollection\AbstractEnumCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\Exception\InvalidTypeException;

/** @covers \Steevanb\PhpCollection\EnumCollection\AbstractEnumCollection::assertClassName */
final class AssertClassNameTest extends TestCase
{
    public function testUnitEnum(): void
    {
        $collection = new TestAbstractEnumCollection(TestEnum::class);

        $collection->callAssertClassName(TestEnum::class);
        $this->addToAssertionCount(1);
    }

    public function testIntEnum(): void
    {
        $collection = new TestAbstractEnumCollection(TestIntEnum::class);

        $collection->callAssertClassName(TestIntEnum::class);
        $this->addToAssertionCount(1);
    }

    public function testStringEnum(): void
    {
        $collection = new TestAbstractEnumCollection(TestStringEnum::class);

        $collection->callAssertClassName(TestStringEnum::class);
        $this->addToAssertionCount(1);
    }

    public function testObject(): void
    {
        $collection = new TestAbstractEnumCollection(TestEnum::class);

        $this->expectException(InvalidTypeException::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage(
            'Steevanb\PhpCollection\EnumCollection\AbstractEnumCollection can store only UnitEnum or BackedEnum. '
            . 'Use Steevanb\PhpCollection\ObjectCollection\AbstractObjectCollection or '
            . 'Steevanb\PhpCollection\ObjectCollection\AbstractObjectNullableCollection if you want to store objects.'
        );
        $collection->callAssertClassName(\stdClass::class);
    }
}
