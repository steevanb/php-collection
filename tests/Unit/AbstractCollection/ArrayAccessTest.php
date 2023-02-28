<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\AbstractCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\Exception\KeyNotFoundException;

final class ArrayAccessTest extends TestCase
{
    public function testOffsetExists(): void
    {
        $collection = new Collection([1, '2', null]);

        static::assertTrue($collection->offsetExists(0));
        static::assertTrue($collection->offsetExists(1));
        static::assertTrue($collection->offsetExists(2));
        static::assertFalse($collection->offsetExists(3));
    }

    public function testOffsetGet(): void
    {
        $collection = new Collection([1, '2', null]);

        static::assertSame(1, $collection->offsetGet(0));
        static::assertSame('2', $collection->offsetGet(1));
        static::assertNull($collection->offsetGet(2));

        static::expectException(KeyNotFoundException::class);
        static::assertFalse($collection->offsetGet(3));
    }

    public function testOffsetSet(): void
    {
        $collection = new Collection();
        $collection->offsetSet(0, 1);
        $collection->offsetSet(1, '2');
        $collection->offsetSet(2, null);

        static::assertSame(1, $collection[0]);
        static::assertSame('2', $collection[1]);
        static::assertNull($collection[2]);
    }

    public function testOffsetUnset(): void
    {
        $collection = new Collection([1, '2', null]);

        static::assertCount(3, $collection);

        $collection->offsetUnset(1);

        static::assertCount(2, $collection);
        static::assertSame(1, $collection[0]);
        static::assertNull($collection[2]);
        static::expectException(KeyNotFoundException::class);
        static::assertFalse($collection[1]);
    }
}
