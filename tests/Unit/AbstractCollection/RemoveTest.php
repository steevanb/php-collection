<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\AbstractCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\{
    Exception\KeyNotFoundException,
    Exception\ReadOnlyException
};

/** @covers \Steevanb\PhpCollection\AbstractCollection::remove */
final class RemoveTest extends TestCase
{
    public function testRemove(): void
    {
        $collection = new TestCollection([1, '2', null]);

        static::assertCount(3, $collection);

        $collection->remove(1);

        static::assertCount(2, $collection);
        static::assertSame(1, $collection->callDoGet(0));
        static::assertNull($collection->callDoGet(2));
        static::assertFalse($collection->hasKey(1));
    }

    public function testKeyNotFound(): void
    {
        $collection = new TestCollection([1, '2', null]);

        $this->expectException(KeyNotFoundException::class);
        $this->expectExceptionMessage('Key "foo" not found.');
        $this->expectExceptionCode(0);
        $collection->remove('foo');
    }

    public function testDoAdd(): void
    {
        $collection = new TestCollection([1, '2', null]);

        $collection
            ->remove(1)
            ->callDoAdd(3);

        static::assertFalse($collection->hasKey(1));
        static::assertSame(3, $collection->callDoGet(3));
    }

    public function testReadOnly(): void
    {
        $collection = (new TestCollection([1, 2]))->setReadOnly();

        $this->expectException(ReadOnlyException::class);
        $this->expectExceptionMessage('This collection is read only, you cannot edit it\'s values.');
        $this->expectExceptionCode(0);
        $collection->remove(0);
    }
}
