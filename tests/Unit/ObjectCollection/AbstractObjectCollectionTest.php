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
        $collection = new TestObjectCollection();

        static::assertSame(ComparisonModeEnum::HASH, $collection->getComparisonMode());
        static::assertSame(ValueAlreadyExistsModeEnum::ADD, $collection->getValueAlreadyExistsMode());
    }

    public function testCanAddValue(): void
    {
        $collection = new TestObjectCollection(
            [
                new TestObject('foo'),
                new TestObject('bar')
            ]
        );

        static::assertSame('foo', $collection->get(0)->getValue());
        static::assertSame('bar', $collection->get(1)->getValue());
    }

    public function testCanAddValueInvalidInstanceOf(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line Parameter #1 $values of class ... expects ..., array<int, DateTime> given. */
        new TestObjectCollection([new \DateTime()]);
    }

    public function testCanAddValueInvalidValueNull(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line Parameter #1 $values ... expects iterable<object>, array<int, null> given. */
        new TestObjectCollection([null]);
    }

    public function testComparisonModeString(): void
    {
        $collection = new TestObjectCollection(
            [
                new TestObject('foo'),
                new TestObject('foo'),
                new TestObject('bar'),
            ],
            ComparisonModeEnum::STRING,
            ValueAlreadyExistsModeEnum::DO_NOT_ADD
        );

        static::assertCount(2, $collection);
        static::assertSame('foo', $collection->get(0)->getValue());
        // @see https://github.com/steevanb/php-collection/issues/15
        static::assertSame('bar', $collection->get(2)->getValue());
    }

    public function testComparisonModeObjectHash(): void
    {
        $collection = new TestObjectCollection(
            [
                new TestObject('foo'),
                new TestObject('foo'),
                new TestObject('bar'),
            ],
            ComparisonModeEnum::HASH,
            ValueAlreadyExistsModeEnum::DO_NOT_ADD
        );

        static::assertCount(3, $collection);
        static::assertSame('foo', $collection->get(0)->getValue());
        static::assertSame('foo', $collection->get(1)->getValue());
        static::assertSame('bar', $collection->get(2)->getValue());
    }
}
