<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Tests\Unit\AbstractTypedArray;

use PHPUnit\Framework\TestCase;
use steevanb\PhpTypedArray\Exception\KeyNotFoundException;

final class ArrayAccessTest extends TestCase
{
    public function testOffsetExists(): void
    {
        $array = new TypedArray([1, '2', null]);

        static::assertSame(true, $array->offsetExists(0));
        static::assertSame(true, $array->offsetExists(1));
        static::assertSame(true, $array->offsetExists(2));
        static::assertSame(false, $array->offsetExists(3));
    }

    public function testOffsetGet(): void
    {
        $array = new TypedArray([1, '2', null]);

        static::assertSame(1, $array->offsetGet(0));
        static::assertSame('2', $array->offsetGet(1));
        static::assertSame(null, $array->offsetGet(2));

        static::expectException(KeyNotFoundException::class);
        static::assertSame(false, $array->offsetGet(3));
    }

    public function testOffsetSet(): void
    {
        $array = new TypedArray();
        $array->offsetSet(0, 1);
        $array->offsetSet(1, '2');
        $array->offsetSet(2, null);

        static::assertSame(1, $array[0]);
        static::assertSame('2', $array[1]);
        static::assertSame(null, $array[2]);
    }

    public function testOffsetUnset(): void
    {
        $array = new TypedArray([1, '2', null]);

        static::assertCount(3, $array);

        $array->offsetUnset(1);

        static::assertCount(2, $array);
        static::assertSame(1, $array[0]);
        static::assertSame(null, $array[2]);
        static::expectException(KeyNotFoundException::class);
        static::assertSame(false, $array[1]);
    }
}
