<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\Tests\Unit\ObjectArray;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpTypedArray\{
    Exception\InvalidTypeException,
    ObjectArray\ComparisonModeEnum,
    ValueAlreadyExistsModeEnum
};

final class AbstractObjectArrayTest extends TestCase
{
    public function testConstructor(): void
    {
        $array = new ObjectArray();

        static::assertSame(TestObject::class, $array->getClassName());
        static::assertSame(ComparisonModeEnum::HASH, $array->getComparisonMode());
    }

    public function testCanAddValue(): void
    {
        $array = new ObjectArray(
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
        new ObjectArray([new \DateTime()]);
    }

    public function testCanAddValueInvalidValueNull(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new ObjectArray([null]);
    }

    public function testComparisonModeString(): void
    {
        $array = new ObjectArray(
            [
                new TestObject('foo'),
                new TestObject('foo'),
                new TestObject('bar'),
            ],
            ComparisonModeEnum::STRING,
            ValueAlreadyExistsModeEnum::DO_NOT_ADD
        );

        static::assertCount(2, $array);
        static::assertInstanceOf(TestObject::class, $array[0]);
        static::assertSame('foo', $array[0]->getValue());
        // @see https://github.com/steevanb/php-typed-array/issues/15
        static::assertInstanceOf(TestObject::class, $array[2]);
        static::assertSame('bar', $array[2]->getValue());
    }

    public function testComparisonModeObjectHash(): void
    {
        $array = new ObjectArray(
            [
                new TestObject('foo'),
                new TestObject('foo'),
                new TestObject('bar'),
            ],
            ComparisonModeEnum::HASH,
            ValueAlreadyExistsModeEnum::DO_NOT_ADD
        );

        static::assertCount(3, $array);
        static::assertInstanceOf(TestObject::class, $array[0]);
        static::assertSame('foo', $array[0]->getValue());
        static::assertInstanceOf(TestObject::class, $array[1]);
        static::assertSame('foo', $array[1]->getValue());
        static::assertInstanceOf(TestObject::class, $array[2]);
        static::assertSame('bar', $array[2]->getValue());
    }
}
