<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\AbstractCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\{
    Exception\ReadOnlyException,
    Exception\ValueAlreadyExistsException,
    ValueAlreadyExistsModeEnum
};

/** @covers \Steevanb\PhpCollection\AbstractCollection::doReplace */
final class DoReplaceTest extends TestCase
{
    public function testDoReplace(): void
    {
        $collection = (new TestCollection())
            ->callDoReplace([10, 11, 12, 13]);

        static::assertCount(4, $collection);
        static::assertSame(10, $collection->callDoGet(0));
        static::assertSame(11, $collection->callDoGet(1));
        static::assertSame(12, $collection->callDoGet(2));
        static::assertSame(13, $collection->callDoGet(3));
    }

    public function testCalledFromConstructor(): void
    {
        $collection = new TestCollection([10, 11, 12, 13]);

        static::assertCount(4, $collection);
        static::assertSame(10, $collection->callDoGet(0));
        static::assertSame(11, $collection->callDoGet(1));
        static::assertSame(12, $collection->callDoGet(2));
        static::assertSame(13, $collection->callDoGet(3));
    }

    public function testReadOnly(): void
    {
        $collection = (new TestCollection([1, 2]))->setReadOnly();

        $this->expectException(ReadOnlyException::class);
        $this->expectExceptionMessage('This collection is read only, you cannot edit it\'s values.');
        $this->expectExceptionCode(0);
        $collection->callDoReplace([3, 4]);
    }

    public function testValueAlreadyExistsDoNotAdd(): void
    {
        $collection = new TestCollection([], ValueAlreadyExistsModeEnum::DO_NOT_ADD);
        $collection->callDoReplace([10, 11, 11, 13]);

        static::assertCount(3, $collection);
        static::assertSame(10, $collection->callDoGet(0));
        static::assertSame(11, $collection->callDoGet(1));
        static::assertSame(13, $collection->callDoGet(3));
    }

    public function testException(): void
    {
        $collection = new TestCollection([], ValueAlreadyExistsModeEnum::EXCEPTION);

        $this->expectException(ValueAlreadyExistsException::class);
        $this->expectExceptionMessage('Value "11" already exists.');
        $this->expectExceptionCode(0);
        $collection->callDoReplace([10, 11, 11]);
    }
}
