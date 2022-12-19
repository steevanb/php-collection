<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\Tests\Unit\ObjectArray;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpTypedArray\{
    Exception\InvalidTypeException,
    ObjectArray\ObjectArray
};

final class SetClassNameTest extends TestCase
{
    public function testSetObject(): void
    {
        $objectArray = (new ObjectArray())
            ->setClassName(TestObject::class);

        static::assertSame(TestObject::class, $objectArray->getClassName());
    }

    public function testSetUnitEnum(): void
    {
        $this->expectException(InvalidTypeException::class);
        $this->expectExceptionCode(0);
        $this->expectDeprecationMessage(
            'Steevanb\PhpTypedArray\ObjectArray\ObjectArray can not store UnitEnum or BackedEnum.'
                . ' Use Steevanb\PhpTypedArray\EnumArray\AbstractEnumArray instead.'
        );
        (new ObjectArray())
            ->setClassName(\UnitEnum::class);
    }

    public function testSetBackedEnum(): void
    {
        $this->expectException(InvalidTypeException::class);
        $this->expectExceptionCode(0);
        $this->expectDeprecationMessage(
            'Steevanb\PhpTypedArray\ObjectArray\ObjectArray can not store UnitEnum or BackedEnum.'
                . ' Use Steevanb\PhpTypedArray\EnumArray\AbstractEnumArray instead.'
        );
        (new ObjectArray())
            ->setClassName(\BackedEnum::class);
    }
}
