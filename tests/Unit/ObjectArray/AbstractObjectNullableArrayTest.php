<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\Tests\Unit\ObjectArray;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpTypedArray\{
    Exception\InvalidTypeException,
    ObjectArray\ComparisonModeEnum,
    ValueAlreadyExistsModeEnum
};

final class AbstractObjectNullableArrayTest extends TestCase
{
    public function testConstructor(): void
    {
        $array = new ObjectNullableArray();

        static::assertSame(TestObject::class, $array->getClassName());
    }

    public function testCanAddValue(): void
    {
        $array = new ObjectNullableArray(
            [
                new TestObject('foo'),
                new TestObject('bar')
            ]
        );

        static::assertInstanceOf(TestObject::class, $array[0]);
        static::assertSame('foo', $array[0]->getValue());
        static::assertInstanceOf(TestObject::class, $array[1]);
        static::assertSame('bar', $array[1]->getValue());
    }

    public function testCanAddValueInvalidInstanceOf(): void
    {
        static::expectException(InvalidTypeException::class);
        new ObjectNullableArray([new \DateTime()]);
    }

    public function testCanAddValueNull(): void
    {
        $array = new ObjectNullableArray([null]);

        static::assertNull($array[0]);
    }

    public function testComparisonModeString(): void
    {
        $array = new ObjectNullableArray(
            [
                new TestObject('foo'),
                new TestObject('foo'),
                new TestObject('bar'),
                null
            ],
            ComparisonModeEnum::STRING,
            ValueAlreadyExistsModeEnum::DO_NOT_ADD
        );

        static::assertCount(3, $array);
        static::assertInstanceOf(TestObject::class, $array[0]);
        static::assertSame('foo', $array[0]->getValue());
        // @see https://github.com/steevanb/php-typed-array/issues/15
        static::assertInstanceOf(TestObject::class, $array[2]);
        static::assertSame('bar', $array[2]->getValue());
        static::assertNull($array[3]);
    }

    public function testComparisonModeObjectHash(): void
    {
        $array = new ObjectNullableArray(
            [
                new TestObject('foo'),
                new TestObject('foo'),
                new TestObject('bar'),
                null
            ],
            ComparisonModeEnum::HASH,
            ValueAlreadyExistsModeEnum::DO_NOT_ADD
        );

        static::assertCount(4, $array);
        static::assertInstanceOf(TestObject::class, $array[0]);
        static::assertSame('foo', $array[0]->getValue());
        static::assertInstanceOf(TestObject::class, $array[1]);
        static::assertSame('foo', $array[1]->getValue());
        static::assertInstanceOf(TestObject::class, $array[2]);
        static::assertSame('bar', $array[2]->getValue());
        static::assertNull($array[3]);
    }
}
