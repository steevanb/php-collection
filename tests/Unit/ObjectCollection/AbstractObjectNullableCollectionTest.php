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
        $collection = new TestObjectNullableCollection();

        static::assertSame(ComparisonModeEnum::HASH, $collection->getComparisonMode());
        static::assertSame(ValueAlreadyExistsModeEnum::ADD, $collection->getValueAlreadyExistsMode());
    }

    public function testCanAddValue(): void
    {
        $collection = new TestObjectNullableCollection(
            [
                new TestObject('foo'),
                new TestObject('bar')
            ]
        );

        static::assertSame('foo', $collection->get(0)?->getValue());
        static::assertSame('bar', $collection->get(1)?->getValue());
    }

    public function testCanAddValueInvalidInstanceOf(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line Parameter #1 $values of ... expects ..., array<int, DateTime> given. */
        new TestObjectNullableCollection([new \DateTime()]);
    }

    public function testCanAddValueNull(): void
    {
        $collection = new TestObjectNullableCollection([null]);

        static::assertNull($collection->get(0));
    }

    public function testComparisonModeString(): void
    {
        $collection = new TestObjectNullableCollection(
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
        static::assertSame('foo', $collection->get(0)?->getValue());
        // @see https://github.com/steevanb/php-collection/issues/15
        static::assertSame('bar', $collection->get(2)?->getValue());
        static::assertNull($collection->get(3));
    }

    public function testComparisonModeObjectHash(): void
    {
        $collection = new TestObjectNullableCollection(
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
        static::assertSame('foo', $collection->get(0)?->getValue());
        static::assertSame('foo', $collection->get(1)?->getValue());
        static::assertSame('bar', $collection->get(2)?->getValue());
        static::assertNull($collection->get(3));
    }
}
