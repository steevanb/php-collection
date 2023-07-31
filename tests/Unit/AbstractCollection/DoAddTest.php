<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\AbstractCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\{
    Exception\ReadOnlyException,
    Exception\ValueAlreadyExistsException,
    ValueAlreadyExistsModeEnum
};

/** @covers \Steevanb\PhpCollection\AbstractCollection::doAdd */
final class DoAddTest extends TestCase
{
    public function testOneValue(): void
    {
        $collection = (new TestCollection())
            ->callDoAdd('foo');

        static::assertSame('foo', $collection->callDoGet(0));
    }

    public function testTreeValue(): void
    {
        $collection = (new TestCollection())
            ->callDoAdd('foo')
            ->callDoAdd('bar')
            ->callDoAdd('baz');

        static::assertSame('foo', $collection->callDoGet(0));
        static::assertSame('bar', $collection->callDoGet(1));
        static::assertSame('baz', $collection->callDoGet(2));
    }

    public function testReadOnly(): void
    {
        $collection = (new TestCollection([1, 2]))->setReadOnly();

        $this->expectException(ReadOnlyException::class);
        $this->expectExceptionMessage('This collection is read only, you cannot edit it\'s values.');
        $this->expectExceptionCode(0);
        $collection->callDoAdd(3);
    }

    public function testValueAlreadyExistsDoNotAdd(): void
    {
        $collection = new TestCollection([], ValueAlreadyExistsModeEnum::DO_NOT_ADD);
        $collection
            ->callDoAdd(10)
            ->callDoAdd(11)
            ->callDoAdd(11)
            ->callDoAdd(13);

        static::assertCount(3, $collection);
        static::assertSame(10, $collection->callDoGet(0));
        static::assertSame(11, $collection->callDoGet(1));
        static::assertSame(13, $collection->callDoGet(2));
    }

    public function testException(): void
    {
        $collection = new TestCollection([], ValueAlreadyExistsModeEnum::EXCEPTION);
        $collection
            ->callDoAdd(10)
            ->callDoAdd(11);

        $this->expectException(ValueAlreadyExistsException::class);
        $this->expectExceptionMessage('Value "11" already exists.');
        $this->expectExceptionCode(0);
        $collection->callDoAdd(11);
    }
}
