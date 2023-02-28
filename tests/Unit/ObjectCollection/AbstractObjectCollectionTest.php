<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\ObjectCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\{
    Exception\InvalidTypeException,
    ObjectCollection\ComparisonModeEnum,
    ValueAlreadyExistsModeEnum
};

final class AbstractObjectCollectionTest extends TestCase
{
    public function testConstructor(): void
    {
        $collection = new ObjectCollection();

        static::assertSame(TestObject::class, $collection->getClassName());
        static::assertSame(ComparisonModeEnum::HASH, $collection->getComparisonMode());
    }

    public function testCanAddValue(): void
    {
        $collection = new ObjectCollection(
            [
                new TestObject('foo'),
                new TestObject('bar')
            ]
        );

        static::assertInstanceOf(TestObject::class, $collection->get(0));
        static::assertSame('foo', $collection->get(0)->getValue());
        static::assertInstanceOf(TestObject::class, $collection->get(1));
        static::assertSame('bar', $collection->get(1)->getValue());
    }

    public function testCanAddValueInvalidInstanceOf(): void
    {
        static::expectException(InvalidTypeException::class);
        new ObjectCollection([new \DateTime()]);
    }

    public function testCanAddValueInvalidValueNull(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new ObjectCollection([null]);
    }

    public function testComparisonModeString(): void
    {
        $collection = new ObjectCollection(
            [
                new TestObject('foo'),
                new TestObject('foo'),
                new TestObject('bar'),
            ],
            ComparisonModeEnum::STRING,
            ValueAlreadyExistsModeEnum::DO_NOT_ADD
        );

        static::assertCount(2, $collection);
        static::assertInstanceOf(TestObject::class, $collection->get(0));
        static::assertSame('foo', $collection->get(0)->getValue());
        // @see https://github.com/steevanb/php-collection/issues/15
        static::assertInstanceOf(TestObject::class, $collection->get(2));
        static::assertSame('bar', $collection->get(2)->getValue());
    }

    public function testComparisonModeObjectHash(): void
    {
        $collection = new ObjectCollection(
            [
                new TestObject('foo'),
                new TestObject('foo'),
                new TestObject('bar'),
            ],
            ComparisonModeEnum::HASH,
            ValueAlreadyExistsModeEnum::DO_NOT_ADD
        );

        static::assertCount(3, $collection);
        static::assertInstanceOf(TestObject::class, $collection->get(0));
        static::assertSame('foo', $collection->get(0)->getValue());
        static::assertInstanceOf(TestObject::class, $collection->get(1));
        static::assertSame('foo', $collection->get(1)->getValue());
        static::assertInstanceOf(TestObject::class, $collection->get(2));
        static::assertSame('bar', $collection->get(2)->getValue());
    }
}
