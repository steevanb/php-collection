<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\Tests\Unit\AbstractTypedArray;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpTypedArray\Exception\KeyNotFoundException;

final class ArrayAccessTest extends TestCase
{
    public function testOffsetExists(): void
    {
        $array = new TypedArray([1, '2', null]);

        static::assertTrue($array->offsetExists(0));
        static::assertTrue($array->offsetExists(1));
        static::assertTrue($array->offsetExists(2));
        static::assertFalse($array->offsetExists(3));
    }

    public function testOffsetGet(): void
    {
        $array = new TypedArray([1, '2', null]);

        static::assertSame(1, $array->offsetGet(0));
        static::assertSame('2', $array->offsetGet(1));
        static::assertNull($array->offsetGet(2));

        static::expectException(KeyNotFoundException::class);
        static::assertFalse($array->offsetGet(3));
    }

    public function testOffsetSet(): void
    {
        $array = new TypedArray();
        $array->offsetSet(0, 1);
        $array->offsetSet(1, '2');
        $array->offsetSet(2, null);

        static::assertSame(1, $array[0]);
        static::assertSame('2', $array[1]);
        static::assertNull($array[2]);
    }

    public function testOffsetUnset(): void
    {
        $array = new TypedArray([1, '2', null]);

        static::assertCount(3, $array);

        $array->offsetUnset(1);

        static::assertCount(2, $array);
        static::assertSame(1, $array[0]);
        static::assertNull($array[2]);
        static::expectException(KeyNotFoundException::class);
        static::assertFalse($array[1]);
    }
}
