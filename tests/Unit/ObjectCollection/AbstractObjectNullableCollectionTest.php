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

        static::assertCount(0, $collection);
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

        static::assertInstanceOf(TestObject::class, $collection->get(0));
        static::assertSame('foo', $collection->get(0)->getValue());
        static::assertInstanceOf(TestObject::class, $collection->get(1));
        static::assertSame('bar', $collection->get(1)->getValue());
    }

    public function testCanAddValueInvalidInstanceOf(): void
    {
        $this->expectException(InvalidTypeException::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage(
            'Value should be an instance of Steevanb\PhpCollection\Tests\Unit\ObjectCollection\TestObject or NULL, '
            . 'stdClass given.'
        );
        /** @phpstan-ignore-next-line Parameter #1 $values ... constructor expects ... array<int, stdClass> given. */
        new TestObjectNullableCollection([new \stdClass()]);
        $this->addToAssertionCount(1);
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
        static::assertInstanceOf(TestObject::class, $collection->get(0));
        static::assertSame('foo', $collection->get(0)->getValue());
        // @see https://github.com/steevanb/php-collection/issues/15
        static::assertInstanceOf(TestObject::class, $collection->get(2));
        static::assertSame('bar', $collection->get(2)->getValue());
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
        static::assertInstanceOf(TestObject::class, $collection->get(0));
        static::assertSame('foo', $collection->get(0)->getValue());
        static::assertInstanceOf(TestObject::class, $collection->get(1));
        static::assertSame('foo', $collection->get(1)->getValue());
        static::assertInstanceOf(TestObject::class, $collection->get(2));
        static::assertSame('bar', $collection->get(2)->getValue());
        static::assertNull($collection->get(3));
    }
}
