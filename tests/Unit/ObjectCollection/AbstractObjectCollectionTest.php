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

        static::assertCount(0, $collection);
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
        $this->expectException(InvalidTypeException::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage(
            'Value should be an instance of Steevanb\PhpCollection\Tests\Unit\ObjectCollection\TestObject, '
            . 'stdClass given.'
        );
        /** @phpstan-ignore-next-line Parameter #1 $values ... constructor expects ... array<int, stdClass> given. */
        new TestObjectCollection([new \stdClass()]);
    }

    public function testCanAddValueInvalidValueNull(): void
    {
        $this->expectException(InvalidTypeException::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage(
            'Value should be an instance of Steevanb\PhpCollection\Tests\Unit\ObjectCollection\TestObject, '
            . 'null given.'
        );
        /** @phpstan-ignore-next-line Parameter #1 $values ... constructor expects ... array<int, null> given. */
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
