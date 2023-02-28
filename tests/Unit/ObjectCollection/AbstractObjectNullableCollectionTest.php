<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\ObjectCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\{
    Exception\InvalidTypeException,
    ObjectCollection\ComparisonModeEnum,
    ValueAlreadyExistsModeEnum
};

final class AbstractObjectNullableCollectionTest extends TestCase
{
    public function testConstructor(): void
    {
        $collection = new ObjectNullableCollection();

        static::assertSame(TestObject::class, $collection->getClassName());
    }

    public function testCanAddValue(): void
    {
        $collection = new ObjectNullableCollection(
            [
                new TestObject('foo'),
                new TestObject('bar')
            ]
        );

        static::assertInstanceOf(TestObject::class, $collection[0]);
        static::assertSame('foo', $collection[0]->getValue());
        static::assertInstanceOf(TestObject::class, $collection[1]);
        static::assertSame('bar', $collection[1]->getValue());
    }

    public function testCanAddValueInvalidInstanceOf(): void
    {
        static::expectException(InvalidTypeException::class);
        new ObjectNullableCollection([new \DateTime()]);
    }

    public function testCanAddValueNull(): void
    {
        $collection = new ObjectNullableCollection([null]);

        static::assertNull($collection[0]);
    }

    public function testComparisonModeString(): void
    {
        $collection = new ObjectNullableCollection(
            [
                new TestObject('foo'),
                new TestObject('foo'),
                new TestObject('bar'),
                null
            ],
            ComparisonModeEnum::STRING,
            ValueAlreadyExistsModeEnum::DO_NOT_ADD
        );

        static::assertCount(3, $collection);
        static::assertInstanceOf(TestObject::class, $collection[0]);
        static::assertSame('foo', $collection[0]->getValue());
        // @see https://github.com/steevanb/php-collection/issues/15
        static::assertInstanceOf(TestObject::class, $collection[2]);
        static::assertSame('bar', $collection[2]->getValue());
        static::assertNull($collection[3]);
    }

    public function testComparisonModeObjectHash(): void
    {
        $collection = new ObjectNullableCollection(
            [
                new TestObject('foo'),
                new TestObject('foo'),
                new TestObject('bar'),
                null
            ],
            ComparisonModeEnum::HASH,
            ValueAlreadyExistsModeEnum::DO_NOT_ADD
        );

        static::assertCount(4, $collection);
        static::assertInstanceOf(TestObject::class, $collection[0]);
        static::assertSame('foo', $collection[0]->getValue());
        static::assertInstanceOf(TestObject::class, $collection[1]);
        static::assertSame('foo', $collection[1]->getValue());
        static::assertInstanceOf(TestObject::class, $collection[2]);
        static::assertSame('bar', $collection[2]->getValue());
        static::assertNull($collection[3]);
    }
}
