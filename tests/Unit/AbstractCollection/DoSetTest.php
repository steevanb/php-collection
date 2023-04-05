<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\AbstractCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\{
    Exception\ReadOnlyException,
    Exception\ValueAlreadyExistsException,
    ValueAlreadyExistsModeEnum
};

/** @covers \Steevanb\PhpCollection\AbstractCollection::doSet */
final class DoSetTest extends TestCase
{
    public function testIntegerKeys(): void
    {
        $collection = new TestCollection();
        $collection->callDoSet(0, 1);
        $collection->callDoSet(1, '2');
        $collection->callDoSet(2, null);

        static::assertSame(1, $collection->callDoGet(0));
        static::assertSame('2', $collection->callDoGet(1));
        static::assertNull($collection->callDoGet(2));
    }

    public function testStringKeys(): void
    {
        $collection = new TestCollection();
        $collection->callDoSet('foo', 1);
        $collection->callDoSet('bar', '2');
        $collection->callDoSet('baz', null);

        static::assertSame(1, $collection->callDoGet('foo'));
        static::assertSame('2', $collection->callDoGet('bar'));
        static::assertNull($collection->callDoGet('baz'));
    }

    public function testStringAndIntKeys(): void
    {
        $collection = new TestCollection();
        $collection->callDoSet('foo', 1);
        $collection->callDoSet(0, '2');
        $collection->callDoSet('baz', null);

        static::assertSame(1, $collection->callDoGet('foo'));
        static::assertSame('2', $collection->callDoGet(0));
        static::assertNull($collection->callDoGet('baz'));
    }

    public function testReadOnly(): void
    {
        $collection = (new TestCollection([1, 2]))->setReadOnly();

        $this->expectException(ReadOnlyException::class);
        $this->expectExceptionMessage('This collection is read only, you cannot edit it\'s values.');
        $this->expectExceptionCode(0);
        $collection->callDoSet(0, 4);
    }

    public function testValueAlreadyExistsDoNotAdd(): void
    {
        $collection = new TestCollection([], ValueAlreadyExistsModeEnum::DO_NOT_ADD);
        $collection
            ->callDoSet(0, 10)
            ->callDoSet(1, 11)
            ->callDoSet(2, 11)
            ->callDoSet(3, 13);

        static::assertCount(3, $collection);
        static::assertSame(10, $collection->callDoGet(0));
        static::assertSame(11, $collection->callDoGet(1));
        static::assertSame(13, $collection->callDoGet(3));
    }

    public function testException(): void
    {
        $collection = new TestCollection([], ValueAlreadyExistsModeEnum::EXCEPTION);
        $collection
            ->callDoSet(0, 10)
            ->callDoSet(1, 11);

        $this->expectException(ValueAlreadyExistsException::class);
        $this->expectExceptionMessage('Value "11" already exists.');
        $this->expectExceptionCode(0);
        $collection->callDoSet(2, 11);
    }
}
