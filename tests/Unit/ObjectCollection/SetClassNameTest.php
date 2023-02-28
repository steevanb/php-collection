<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\ObjectCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\{
    Exception\InvalidTypeException,
    ObjectCollection\ComparisonModeEnum,
    ValueAlreadyExistsModeEnum
};

final class SetClassNameTest extends TestCase
{
    public function testSetObject(): void
    {
        $collection = new ObjectCollection();

        static::assertSame(TestObject::class, $collection->getClassName());
    }

    public function testSetUnitEnum(): void
    {
        $this->expectException(InvalidTypeException::class);
        $this->expectExceptionCode(0);
        $this->expectDeprecationMessage(
            'Steevanb\PhpCollection\ObjectCollection\AbstractObjectCollection can not store UnitEnum or BackedEnum.'
                . ' Use Steevanb\PhpCollection\EnumCollection\AbstractEnumCollection instead.'
        );
        new ObjectCollection([], ComparisonModeEnum::HASH, ValueAlreadyExistsModeEnum::ADD, \UnitEnum::class);
    }

    public function testSetBackedEnum(): void
    {
        $this->expectException(InvalidTypeException::class);
        $this->expectExceptionCode(0);
        $this->expectDeprecationMessage(
            'Steevanb\PhpCollection\ObjectCollection\AbstractObjectCollection can not store UnitEnum or BackedEnum.'
                . ' Use Steevanb\PhpCollection\EnumCollection\AbstractEnumCollection instead.'
        );
        new ObjectCollection([], ComparisonModeEnum::HASH, ValueAlreadyExistsModeEnum::ADD, \BackedEnum::class);
    }
}
