<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Tests\ObjectArray;

use PHPUnit\Framework\TestCase;
use steevanb\PhpTypedArray\{
    Exception\InvalidTypeException,
    ObjectArray\ObjectArray
};

final class ObjectArrayTest extends TestCase
{
    public function testConstructor(): void
    {
        $array = new ObjectArray([], TestObject::class);

        static::assertSame(TestObject::class, $array->getClassName());
    }

    public function testSetClassName(): void
    {
        $array = (new ObjectArray())
            ->setClassName(TestObject::class);

        static::assertSame(TestObject::class, $array->getClassName());
    }

    public function testCanAddValue(): void
    {
        $array = new ObjectArray(
            [
                new TestObject('foo'),
                new TestObject('bar')
            ],
            TestObject::class
        );

        static::assertSame('foo', (string) $array[0]);
        static::assertSame('bar', (string) $array[1]);
    }

    public function testCanAddValueException(): void
    {
        static::expectException(InvalidTypeException::class);
        new ObjectArray(
            [
                new TestObject('foo'),
                new TestObject('bar'),
                new \DateTime()
            ],
            TestObject::class
        );
    }

    public function testCanAddValueObject(): void
    {
        $array = new ObjectArray(
            [
                new TestObject('foo'),
                new TestObject('bar'),
                new \DateTime()
            ]
        );

        static::assertSame('foo', (string) $array[0]);
        static::assertSame('bar', (string) $array[1]);
        static::assertSame(\DateTime::class, get_class($array[2]));
    }

    public function testComparidonModeString(): void
    {
        $array = (new ObjectArray())
            ->setValueAlreadyExistMode(ObjectArray::VALUE_ALREADY_EXIST_DO_NOT_ADD)
            ->setValues(
                [
                    new TestObject('foo'),
                    new TestObject('foo'),
                    new TestObject('bar'),
                ]
            );

        static::assertCount(2, $array);
        static::assertSame('foo', (string) $array[0]);
        // @see https://github.com/steevanb/php-typed-array/issues/15
        static::assertSame('bar', (string) $array[2]);
    }

    public function testComparidonModeObjectHas(): void
    {
        $array = (new ObjectArray())
            ->setComparisonMode(ObjectArray::COMPARISON_OBJECT_HASH)
            ->setValueAlreadyExistMode(ObjectArray::VALUE_ALREADY_EXIST_DO_NOT_ADD)
            ->setValues(
                [
                    new TestObject('foo'),
                    new TestObject('foo'),
                    new TestObject('bar'),
                ]
            );

        static::assertCount(3, $array);
        static::assertSame('foo', (string) $array[0]);
        static::assertSame('foo', (string) $array[1]);
        static::assertSame('bar', (string) $array[2]);
    }
}
